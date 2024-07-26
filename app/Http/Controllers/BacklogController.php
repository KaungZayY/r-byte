<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class BacklogController extends Controller
{
    public function create(Project $project)
    {
        return view('backlogs.create-backlog',compact('project'));
    }
}
