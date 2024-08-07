<?php

namespace App\Http\Controllers;

use App\Models\Team;
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
}
