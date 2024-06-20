<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $projects = $this->getAllProjects();
        return view('livewire.dashboard',['projects'=>$projects]);
    }

    public function getAllProjects(): Collection
    {
        $user = auth()->user();

        $ownProjects = Project::where('created_by',$user->id)->with('user')->get();

        $teamProjects = Project::whereHas('teams.teammates', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('user')->get();

        $projects = $ownProjects->merge($teamProjects)->unique('id');

        return $projects;
    }
}
