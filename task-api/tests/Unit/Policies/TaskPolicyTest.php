<?php

namespace Tests\Unit\Policies;

use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskPolicyTest extends TestCase
{
    use RefreshDatabase;

    private TaskPolicy $policy;
    private User $user;
    private User $otherUser;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->policy = new TaskPolicy();

        // Criar usuários para teste
        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();

        // Criar uma task para teste
        $this->task = Task::factory()->create([
            'owner_id' => $this->user->id
        ]);
    }

    public function test_view_any_returns_true_for_authenticated_users(): void
    {
        $this->assertTrue($this->policy->viewAny($this->user));
    }

    public function test_view_returns_true_for_task_owner(): void
    {
        $this->assertTrue($this->policy->view($this->user, $this->task));
    }

    public function test_view_returns_false_for_non_owner(): void
    {
        $this->assertFalse($this->policy->view($this->otherUser, $this->task));
    }

    public function test_create_returns_true_for_authenticated_users(): void
    {
        $this->assertTrue($this->policy->create($this->user));
    }

    public function test_update_returns_true_for_task_owner(): void
    {
        $this->assertTrue($this->policy->update($this->user, $this->task));
    }

    public function test_update_returns_false_for_non_owner(): void
    {
        $this->assertFalse($this->policy->update($this->otherUser, $this->task));
    }

    public function test_delete_returns_true_for_task_owner(): void
    {
        $this->assertTrue($this->policy->delete($this->user, $this->task));
    }

    public function test_delete_returns_false_for_non_owner(): void
    {
        $this->assertFalse($this->policy->delete($this->otherUser, $this->task));
    }
} 