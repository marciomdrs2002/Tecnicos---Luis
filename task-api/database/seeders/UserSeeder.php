<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Criando usuário de teste
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste@email.com',
            'password' => Hash::make('senha123'),
        ]);

        // Criando mais alguns usuários para teste
        User::create([
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'password' => Hash::make('senha123'),
        ]);

        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@email.com',
            'password' => Hash::make('senha123'),
        ]);
    }
}
