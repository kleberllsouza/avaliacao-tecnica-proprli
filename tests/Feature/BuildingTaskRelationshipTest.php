<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Building;
use App\Models\Task;

class BuildingTaskRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function testBuildingHasTasks()
    {
        $building = Building::factory()->create();
        Task::factory()->count(3)->create(['building_id' => $building->id]);

        $this->assertCount(3, $building->tasks);
    }
}
