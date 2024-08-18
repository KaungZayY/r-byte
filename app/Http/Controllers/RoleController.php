<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create(Team $team)
    {
        return view('roles.create-role',compact('team'));
    }

    public function store(Team $team, Request $request)
    {
        $validated = $request->validate(['role_name'=>'required']);
        try {
            Role::create([
                'team_id' => $team->id,
                'role_name' => $validated['role_name']
            ]);
            
            return redirect()->route('teammates',$team)->banner('New Role Created!');

        } 
        catch (\Exception $e) 
        {
            dd($e);
            return redirect()->route('teammates',$team)->dangerBanner('An Error Occured');
        }
    }
}
