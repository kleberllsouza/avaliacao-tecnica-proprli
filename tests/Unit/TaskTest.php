<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Building;

class TaskTest extends TestCase
{
    public function testCreateTask()
    {
        $task = \App\Models\Task::factory()->create();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $task->title,
        ]);
    }
    /**
     * ScopeFilter tests whether it applies filters correctly.
     *
     * @return void
     */
    public function testScopeFilterAppliesStatusFilter()
    {
        $building = Building::factory()->create();

        $task1 = Task::factory()->create([
            'building_id' => $building->id,
            'status' => 'Open'
        ]);

        $task2 = Task::factory()->create([
            'building_id' => $building->id,
            'status' => 'Completed'
        ]);

        $tasks = Task::filter(['status' => 'Open'])->get();

        $this->assertTrue($tasks->contains($task1));
        $this->assertFalse($tasks->contains($task2));
    }
}
