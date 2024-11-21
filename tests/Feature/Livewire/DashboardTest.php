<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Dashboard;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    public function check_projects_are_displayed_if_exists(): void
    {
        $user = User::factory()->create();

        $projects = Project::factory()->count(2)->create(['created_by' => $user->id]);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->assertViewHas('projects', function ($collection) use ($projects){
                return $projects->every(fn($project) => $collection->contains('id', $project->id));
            });
    }
}
