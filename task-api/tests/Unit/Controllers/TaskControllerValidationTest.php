<?php

namespace Tests\Unit\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerValidationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_store_validates_required_title(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/tasks', [
                'description' => 'Test description'
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_store_validates_title_is_string(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/tasks', [
                'title' => 123
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_store_validates_title_max_length(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/tasks', [
                'title' => str_repeat('a', 256)
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_store_allows_optional_description(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/tasks', [
                'title' => 'Test Task'
            ]);

        $response->assertStatus(201);
    }

    public function test_update_validates_title_when_present(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->putJson("/api/tasks/{$task->id}", [
                'title' => 123
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_update_validates_description_when_present(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->putJson("/api/tasks/{$task->id}", [
                'description' => 123
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['description']);
    }

    public function test_update_validates_status_when_present(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->putJson("/api/tasks/{$task->id}", [
                'status' => 'invalid_status'
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['status']);
    }

    public function test_update_accepts_valid_status(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $validStatuses = ['pending', 'in_progress', 'completed'];

        foreach ($validStatuses as $status) {
            $response = $this->actingAs($this->user)
                ->putJson("/api/tasks/{$task->id}", [
                    'status' => $status
                ]);

            $response->assertStatus(200);
        }
    }
} 