<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'email@admin.com',
        //     'password' => bcrypt('asdfasdf'),
        //     'role' => 'admin',
        // ]);

        Subject::create(["name" => "Pemrograman"]);
        Subject::create(["name" => "Desain Grafis"]);
        Subject::create(["name" => "Jaringan Komputer"]);
    }
}
