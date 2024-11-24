<?php
namespace App\Helpers;

use App\Models\User;

class FeatureTestHelper{
    public function createTestUser(): User
    {
        return User::factory()->create();
    }
}