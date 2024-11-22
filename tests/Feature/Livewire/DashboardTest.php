<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Dashboard;
use App\Models\Project;
use App\Models\Team;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function renders_successfully_with_search_sort_and_create_project_components(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->assertSee('Search')
            ->assertSee('Sort by')
            ->assertSee('New Project')
            ->assertStatus(200);
    }

    /** @test */
    public function check_own_projects_are_displayed_if_exists(): void
    {
        $user = User::factory()->create();

        $projects = Project::factory()->count(2)->create(['created_by' => $user->id]);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->assertViewHas('projects', function ($collection) use ($projects){
                return $projects->every(fn($project) => $collection->contains('id', $project->id));
            });
    }

    /** @test */
    public function check_team_projects_are_displayed_if_exists(): void
    {
        $authUser = User::factory()->create();

        $projectOwner = User::factory()->create();
        $project = Project::factory()->create(['created_by' => $projectOwner->id]);
        $team = Team::factory()->create(['project_id' => $project->id]);
        Teammate::factory()->create(['user_id' => $authUser->id, 'team_id' => $team->id]);

        Livewire::actingAs($authUser)
            ->test(Dashboard::class)
            ->assertViewHas('projects', function ($collection) use ($project){
                return $collection->contains($project);
            });
    }

    /** @test */
    public function check_if_sorting_asc_works(): void
    {
        $user = User::factory()->create();

        Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Project A']);
        Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Project Z']);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->set('sort', 'ASC')
            ->assertSeeInOrder(['Project A', 'Project Z']);
    }

    /** @test */
    public function check_if_sorting_desc_works(): void
    {
        $user = User::factory()->create();

        Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Project A']);
        Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Project Z']);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->set('sort', 'DESC')
            ->assertSeeInOrder(['Project Z', 'Project A']);
    }

    /** @test */
    public function check_if_search_works(): void
    {
        $user = User::factory()->create();

        $matchingProject = Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Matching Project']);
        $unrelatedProject = Project::factory()->create(['created_by' => $user->id, 'project_name' => 'Unrelated Project']);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->set('search', 'Matching')
            ->assertViewHas('projects', function ($collection) use ($matchingProject){
                return $collection->contains($matchingProject);
            })
            ->assertViewHas('projects', function ($collection) use ($unrelatedProject) {
                return !$collection->contains($unrelatedProject);
            });
    }
}
