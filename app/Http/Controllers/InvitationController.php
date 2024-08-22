<?php

namespace App\Http\Controllers;

use App\Mail\TeamInvitationMail;
use App\Models\Invitation;
use App\Models\Team;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function index(Team $team)
    {
        $project = $team->project;
        return view('invitations.create-invitation',compact('team','project'));
    }

    public function sentInvite(Team $team, Request $request)
    {
        $request->validate(['email'=>'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('invites',$team)->dangerBanner('This email is not registered.');
        }

        $existingTeammate = Teammate::where('team_id', $team->id)->where('user_id', $user->id)->first();
        if ($existingTeammate) 
        {
            return redirect()->route('teammates',$team)->banner('The Team Mate is already in the Team.');
        }

        $token = Str::random(32);

        $recipient_name = $user->name;
        $sender_name = Auth::user()->name;

        try 
        {
            $invitation = Invitation::create([
                'email' => $request->email,
                'team_id' => $team->id,
                'token' => $token,
                'invited_by' => Auth::user()->id
            ]);
            Mail::to($request->email)->send(new TeamInvitationMail($invitation, $team, $recipient_name, $sender_name));
            return redirect()->route('teammates',[$team->project, $team])->banner('Invitation sent successfully.');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('invites',$team)->dangerBanner('Cannot Invite this user at the moment');
        }
    }

    public function acceptInvite($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();
        $user = User::where('email', $invitation->email)->firstOrFail();
        $teamName = $invitation->team->team_name;
        $existingTeammate = Teammate::where('team_id', $invitation->team_id)->where('user_id', $user->id)->first();

        if ($existingTeammate) 
        {
            $invitation->delete();
            $messageType = 'already_member';
            return view('invitations.message-invitation',compact('teamName','messageType'));
        }


        try {
            Teammate::create([
                'team_id' => $invitation->team_id,
                'user_id' => $user->id,
                'invited_by' => $invitation->invited_by
            ]);
            $invitation->delete();
            $messageType = 'successful';
            return view('invitations.message-invitation',compact('teamName','messageType'));

        } catch (\Exception $e) {
            $messageType = 'invalid';
            return view('invitations.message-invitation',compact('teamName'));
        }
    }
}
