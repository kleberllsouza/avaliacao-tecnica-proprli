<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTaskValidationFailsWithMissingFields()
    {
        $payload = [];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'building_id',
                'assigned_user_id',
                'title',
                'status',
            ]);
    }
}
