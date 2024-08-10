<?php

namespace App\Http\Controllers;

use App\Mail\TeamInvitationMail;
use App\Models\Invitation;
use App\Models\Team;
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
        $token = Str::random(32);

        $recipient_name = $user->name;
        $sender_name = Auth::user()->name;

        try 
        {
            $invitation = Invitation::create([
                'email' => $request->email,
                'team_id' => $team->id,
                'token' => $token,
            ]);
            Mail::to($request->email)->send(new TeamInvitationMail($invitation, $team, $recipient_name, $sender_name));
            return redirect()->route('teammates',$team)->banner('Invitation sent successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('invites',$team)->dangerBanner('Cannot Invite this user at the moment');
        }
    }

    public function acceptInvite($token)
    {
        dd($token);
    }
}
