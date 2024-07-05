<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    public $search = '';
    public $sort = '';

    public function render()
    {
        $projects = $this->getUserProjects();
        return view('livewire.dashboard',['projects'=>$projects]);
    }

    public function getUserProjects(): Collection
    {
        $user = auth()->user();

        $ownProjects = Project::where('created_by',$user->id)->where('project_name', 'like', '%' . $this->search . '%')->with('user')->get();

        $teamProjects = Project::whereHas('teams.teammates', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('project_name', 'like', '%' . $this->search . '%')->with('user')->get();

        $projects = $ownProjects->merge($teamProjects)->unique('id');

        if($this->sort)
        {
            if($this->sort == 'ASC'){
                $projects = $projects->sortBy('project_name');
            }
            else if($this->sort == 'DESC'){
                $projects = $projects->sortByDesc('project_name');
            }
            else{
                $projects = $projects;
            }
        }

        return $projects;
    }
}
