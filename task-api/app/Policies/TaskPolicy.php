<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine se o usuário pode visualizar qualquer task.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos usuários autenticados podem ver suas tasks
    }

    /**
     * Determine se o usuário pode ver uma task específica.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id;
    }

    /**
     * Determine se o usuário pode criar tasks.
     */
    public function create(User $user): bool
    {
        return true; // Todos usuários autenticados podem criar tasks
    }

    /**
     * Determine se o usuário pode atualizar uma task.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id;
    }

    /**
     * Determine se o usuário pode deletar uma task.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id;
    }
}