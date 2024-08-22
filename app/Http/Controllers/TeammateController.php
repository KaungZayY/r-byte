<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\Models\Teammate;
use Illuminate\Http\Request;

class TeammateController extends Controller
{
    public function index(Project $project, Team $team)
    {
        $teammates = $team->teammates()->with('user')->with('role')->get();
        $count = $teammates->count();
        return view('teammates.index-teammate',compact('teammates','team','project','count'));
    }

    public function addRole(Teammate $teammate)
    {
        $teammate->load('user')->load('team');
        $project = $teammate->team->project;
        $roles = Role::where('team_id',$teammate->team->id)->get();
        return view('teammates.edit-teammate-role',compact('teammate','project','roles'));
    }

    public function assignRole(Request $request, Teammate $teammate)
    {
        $request->validate(['role_id'=>'required|exists:roles,id']);
        $project = $teammate->team->project;
        try {
            $teammate->update([
                'role_id' => $request->role_id
            ]);
            return redirect()->route('teammates',[$project,$teammate->team])->banner('Role has been successfully assigned.');

        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('teammates',[$project,$teammate->team])->dangerBanner('Cannot assign role to this user');
        }
    }

    public function destroy(Teammate $teammate)
    {
        $team = $teammate->team;
        $name = $teammate->user->name;
        $project = $teammate->team->project;
        try 
        {
            $teammate->delete();

            return redirect()->route('teammates',[$project,$teammate->team])->banner("{$name} has been removed from the team.");
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('invites',$team)->dangerBanner('Cannot remove this user form the team');
        }
    }
}
