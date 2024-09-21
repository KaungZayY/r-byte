<?php
namespace App\Helpers;

use App\Models\Feature;
use App\Models\Project;
use App\Models\Status;
use Ramsey\Uuid\Type\Integer;

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
        $position = 1;
        foreach ($statuses as $status){
            $status_type = $this->checkStartAndFinishStatuses($status);
            Status::create([
                'project_id' => $project->id,
                'status' => $status,
                'status_type' => $status_type,
                'position' => $position,
            ]);
            $position = $position + 1;
        }
    }

    private function checkStartAndFinishStatuses($status): ?int
    {
        $status = strtolower($status);
        if($status === 'to do'){
            return 1;
        }
        else if($status === 'done'){
            return 2;
        }
        return null;
    }
}