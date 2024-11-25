<?php
namespace App\Helpers;

use App\Models\Project;
use App\Models\User;

class FeatureTestHelper{
    public function createTestUser(): User
    {
        return User::factory()->create();
    }

    public function createTestProject(): Project
    {
        return Project::factory()->create();
    }
}