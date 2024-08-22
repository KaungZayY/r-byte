<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create(Project $project, Team $team)
    {
        return view('roles.create-role',compact('team','project'));
    }

    public function store(Project $project, Team $team, RoleRequest $request)
    {
        $validated = $request->validated();
        try {
            Role::create([
                'team_id' => $team->id,
                'role_name' => $validated['role_name'],
                'description' => $validated['description']
            ]);
            
            return redirect()->route('teammates',[$project,$team])->banner('New Role Created!');

        } 
        catch (\Exception $e) 
        {
            dd($e);
            return redirect()->route('teammates',[$project,$team])->dangerBanner('An Error Occured');
        }
    }
}
