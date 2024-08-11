<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\Teammate;
use Illuminate\Http\Request;

class TeammateController extends Controller
{
    public function index(Team $team)
    {
        $teammates = $team->teammates()->with('user')->with('role')->get();
        $count = $teammates->count();
        $project = $team->project;
        return view('teammates.index-teammate',compact('teammates','team','project','count'));
    }

    public function addRole(Teammate $teammate)
    {
        $teammate->load('user');
        $roles = Role::all();
        $team = $teammate->team;
        $project = $team->project;
        return view('teammates.edit-teammate-role',compact('teammate','project','team','roles'));
    }

    public function assignRole(Request $request, Teammate $teammate)
    {
        $request->validate(['role_id'=>'required|exists:roles,id']);

        try {
            $teammate->update([
                'role_id' => $request->role_id
            ]);
            return redirect()->route('teammates',$teammate->team)->banner('Role has been successfully assigned.');

        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('invites',$teammate->team)->dangerBanner('Cannot assign role to this user');
        }
    }
}
