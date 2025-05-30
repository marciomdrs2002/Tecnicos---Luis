<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $statuses = ['pending', 'in_progress', 'completed'];

        foreach ($users as $user) {
            // Criando 5 tarefas para cada usuário
            for ($i = 1; $i <= 5; $i++) {
                Task::create([
                    'user_id' => $user->id,
                    'title' => "Tarefa {$i} do {$user->name}",
                    'description' => "Esta é a descrição da tarefa {$i} do usuário {$user->name}. Esta tarefa foi criada automaticamente pelo seeder.",
                    'status' => $statuses[array_rand($statuses)], // Status aleatório
                ]);
            }
        }
    }
}
