<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Project $project): void
    {
        $seeder = new SeederHelper();
        $seeder->seedDefaultStatuses($project,'To Do','In Progress','Done');
    }
}
