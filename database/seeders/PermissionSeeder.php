<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //'Sprints','Teams','Backlogs','Teammates','Roles'
        $seeder = new SeederHelper();
        $seeder->createPermissions('Sprints','View','Create','Update','Delete');
        $seeder->createPermissions('Teams','View','Create','Update','Delete');
        $seeder->createPermissions('Backlogs','View','Create','Update','Delete');
        $seeder->createPermissions('Teammates','View','Create','Update','Delete');
        $seeder->createPermissions('Roles','View','Create','Update','Delete');
    }
}
