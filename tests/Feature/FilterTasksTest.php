<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;;
use App\Models\Building;
use App\Models\Task;
use App\Models\User;

class FilterTasksTest extends TestCase
{
    use RefreshDatabase;

    public function testListTasksWithStatusFilter()
    {
        $building = Building::factory()->create();
        $user = User::factory()->create();

        $taskOpen = Task::factory()->create([
            'building_id' => $building->id,
            'assigned_user_id' => $user->id,
            'status' => 'Open'
        ]);

        $taskCompleted = Task::factory()->create([
            'building_id' => $building->id,
            'assigned_user_id' => $user->id,
            'status' => 'Completed'
        ]);

        $response = $this->getJson("/api/buildings/{$building->id}/tasks?status=Open");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'Open'])
                 ->assertJsonMissing(['status' => 'Completed']);
    }
}
