<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Building;
use App\Models\User;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCommentForTask()
    {
        $building = Building::factory()->create();
        $user = User::factory()->create();
        $task = \App\Models\Task::factory()->create([
            'building_id' => $building->id,
            'assigned_user_id' => $user->id,
            'status' => 'Open'
        ]);

        $payload = [
            'user_id' => $user->id,
            'comment' => 'This is a test comment'
        ];

        $response = $this->postJson("/api/tasks/{$task->id}/comments", $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'comment' => 'This is a test comment'
                 ]);

        $this->assertDatabaseHas('comments', [
            'task_id' => $task->id,
            'comment' => 'This is a test comment'
        ]);
    }
}
