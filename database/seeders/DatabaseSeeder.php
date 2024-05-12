<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createUsers();
        $this->createAdmins();
        $this->createGames();
    }

    private function createUsers(): void
    {
        User::truncate();

        User::factory(5)->create();
        User::factory()->create([
            'fullname' => 'Test user 01',
            'username' => 'test01',
            'email' => 'test@example.com',
            'password' => Hash::make('123456'),
            'address' => fake()->address(),
        ]);
    }

    private function createAdmins(): void
    {
        Admin::truncate();
        Admin::create([
            'fullname' => 'Admin 01',
            'username' => 'admin01',
            'password' => Hash::make('123456'),
        ]);
    }

    private function createGames(): void
    {
        Game::truncate();
        Game::insert([
            [
                'title' => 'PUBG',
                'admin_id' => 1,
            ],
            [
                'title' => 'Call of duty',
                'admin_id' => 1,
            ],
            [
                'title' => 'Fortnite',
                'admin_id' => 1,
            ],
        ]);
    }
}
