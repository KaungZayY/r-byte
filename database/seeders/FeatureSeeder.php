<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new SeederHelper();
        $seeder->createFeature('Sprints','Teams','Backlogs','Teammates','Roles');
    }
}
