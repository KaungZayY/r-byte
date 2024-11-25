<?php

namespace Tests\Feature;

use App\Helpers\FeatureTestHelper;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private $featureTestHelper;

    protected function setUp(): void
    {
        parent::setUp();
        $this->featureTestHelper = new FeatureTestHelper();
        $this->user = $this->featureTestHelper->createTestUser();
    }

    public function test_create_new_project_successful(): void
    {
        $project = [
            'project_name' => 'Test Project',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addMonth()->format('Y-m-d'),
            'description' => null,
            'created_by' => $this->user->id,
        ];
        $response = $this->actingAs($this->user)->post('/projects/create', $project);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        
        $this->assertDatabaseHas('projects', $project);

        $latestProject = Project::latest()->first();

        $this->assertEquals($project['project_name'], $latestProject->project_name);
        $this->assertEquals($project['start_date'], $latestProject->start_date);
        $this->assertEquals($project['end_date'], $latestProject->end_date);
    }

    public function test_edit_project_view_contains_correct_values(): void
    {
        $project = $this->featureTestHelper->createTestProject();

        $response = $this->actingAs($this->user)->get('/projects/'.$project->id.'/edit');

        $response->assertStatus(200);
        $response->assertSee('value="'.$project->project_name.'"',false);
        $response->assertSee('value="'.$project->start_date.'"',false);
        $response->assertSee('value="'.$project->end_date.'"',false);
        $response->assertViewHas('project', $project);
    }

    public function test_update_project_validation_error_redirect_back_to_form(): void
    {
        $project = $this->featureTestHelper->createTestProject();

        $updatedProject = [
            'project_name' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => null
        ];

        $response = $this->actingAs($this->user)->put('/projects/'.$project->id.'/edit', $updatedProject);

        $response->assertStatus(302);
        $response->assertInvalid(['project_name','start_date','end_date']);
    }

    public function test_update_project_by_owner_works_correctly(): void
    {
        $project = Project::factory()->create(['created_by'=>$this->user->id]);

        $updatedProject = [
            'project_name' => 'Updated Project',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addMonth()->format('Y-m-d'),
            'description' => null
        ];
        $response = $this->actingAs($this->user)->put('/projects/'.$project->id.'/edit', $updatedProject);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('projects', $updatedProject);

        $latestUpdate = Project::find($project->id);

        $this->assertEquals($latestUpdate->project_name, $updatedProject['project_name']);
        $this->assertEquals($latestUpdate->start_date, $updatedProject['start_date']);
        $this->assertEquals($latestUpdate->end_date, $updatedProject['end_date']);
    }

    public function test_prevent_update_project_by_non_owner(): void
    {
        $project = Project::factory()->create();

        $updatedProject = [
            'project_name' => 'Updated Project',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addMonth()->format('Y-m-d'),
            'description' => null
        ];
        $response = $this->actingAs($this->user)->put('/projects/'.$project->id.'/edit', $updatedProject);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $latestUpdate = Project::find($project->id);

        $this->assertNotEquals($latestUpdate->project_name, $updatedProject['project_name']);
        $this->assertNotEquals($latestUpdate->start_date, $updatedProject['start_date']);
        $this->assertNotEquals($latestUpdate->end_date, $updatedProject['end_date']);
    }
}
