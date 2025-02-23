<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Building;

class TaskFilterScopeTest extends TestCase
{
    use RefreshDatabase;

    public function testScopeFilterAppliesStatusFilter()
    {
        $building = Building::factory()->create();

        $taskOpen = Task::factory()->create([
            'building_id' => $building->id,
            'status' => 'Open'
        ]);

        $taskCompleted = Task::factory()->create([
            'building_id' => $building->id,
            'status' => 'Completed'
        ]);

        $tasks = Task::filter(['status' => 'Open'])->get();

        $this->assertTrue($tasks->contains($taskOpen));
        $this->assertFalse($tasks->contains($taskCompleted));
    }
}
