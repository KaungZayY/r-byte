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
        [$teammates, $roles] = $team->teammatesWithRoles($project);
        $count = $teammates->count();
        return view('teammates.index-teammate',compact('teammates','team','project','count','roles'));
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
