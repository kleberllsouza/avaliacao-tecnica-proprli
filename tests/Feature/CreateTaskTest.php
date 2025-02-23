<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Building;
use App\Models\User;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test the creation of a new task via endpoint.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $building = Building::factory()->create();
        $user = User::factory()->create();

        $payload = [
            'building_id'      => $building->id,
            'assigned_user_id' => $user->id,
            'title'            => 'Test Task',
            'description'      => 'Test description',
            'status'           => 'Open'
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'Test Task',
                'status' => 'Open'
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'status' => 'Open'
        ]);
    }
}
