<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\Models\Teammate;
use Illuminate\Http\Request;

class TeammateController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }


    public function index(Project $project, Team $team)
    {
        $this->pHelper->authorizeUser($project,'Teammates','View');
        [$teammates, $roles] = $team->teammatesWithRoles($project);
        $count = $teammates->count();
        return view('teammates.index-teammate',compact('teammates','team','project','count','roles'));
    }


    public function destroy(Teammate $teammate)
    {
        $team = $teammate->team;
        $name = $teammate->user->name;
        $project = $teammate->team->project;
        $this->pHelper->authorizeUser($project,'Teammates','Delete');
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
