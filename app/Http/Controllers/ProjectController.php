<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create-project');
    }
}
