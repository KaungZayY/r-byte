<?php

namespace Tests\Feature;

use App\Livewire\Dashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login_page_if_not_authenticated(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    public function test_dashboard_component_exists_on_dashboard_view_when_user_logged_in(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertSeeLivewire(Dashboard::class);
        $response->assertSee('Dashboard');
        $response->assertStatus(200);
    }
}
