<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Question, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        Question::factory()->count(10)->create();
    }
}
