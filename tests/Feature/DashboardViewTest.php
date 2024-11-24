<?php

namespace Tests\Feature;

use App\Livewire\Dashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Helpers\FeatureTestHelper;

class DashboardViewTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $featureTestHelper = new FeatureTestHelper();
        $this->user = $featureTestHelper->createTestUser();
    }

    public function test_redirect_to_login_page_if_not_authenticated(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    public function test_dashboard_component_exists_on_dashboard_view_when_user_logged_in(): void
    {
        $response = $this->actingAs($this->user)->get('/');

        $response->assertSeeLivewire(Dashboard::class);
        $response->assertSee('Dashboard');
        $response->assertStatus(200);
    }
}
