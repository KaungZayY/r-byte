<?php
namespace App\Helpers;

use App\Models\Feature;
use App\Models\Project;
use App\Models\Status;

class SeederHelper{

    public function createFeature(...$features): void
    {
        foreach ($features as $feature){
            Feature::create([
                'feature_name' => $feature
            ]);
        }
    }

    public function createPermissions($featureName, ...$permissions): void
    {
        $feature = Feature::where('feature_name', $featureName)->firstOrFail();

        foreach($permissions as $permission){
            $feature->permissions()->create([
                'permission_name' => $permission
            ]);
        }
    }

    public function seedDefaultStatuses(Project $project, ...$statuses): void
    {
        foreach ($statuses as $status){
            Status::create([
                'project_id' => $project->id,
                'status' => $status
            ]);
        }
    }
}