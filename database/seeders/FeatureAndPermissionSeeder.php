<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use Illuminate\Database\Seeder;

class FeatureAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new SeederHelper();

        $seeder->createFeature('Teams','Teammates','Backlogs','Sprints','Roles','Tickets','Statuses');

        $seeder->createPermissions('Teams','View','Create','Update','Delete','Archives','Restore','ForceDelete');
        $seeder->createPermissions('Teammates','View','Invite','AssignRole','ReassignRole','Delete');
        $seeder->createPermissions('Backlogs','View','Create','Update','Delete','Archives','Restore','ForceDelete');
        $seeder->createPermissions('Sprints','View','Create','Update','Delete','Archives','Restore','ForceDelete','StartSprint');
        $seeder->createPermissions('Roles','View','Create','Update','Delete','Archives','Restore','ForceDelete','GrantPermission');
        $seeder->createPermissions('Tickets','Create','Update','Delete','Detail','AssignTeammate','RemoveTeammate');
        $seeder->createPermissions('Statuses','Create','Update','Delete');
    }
}
