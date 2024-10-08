<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@dtw.com.mx',
            'password' => bcrypt('321321321'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'AngelV',
            'email' => 'angel@gmail.com',
            'password' => bcrypt('321321321'),
        ]);
    }
}
