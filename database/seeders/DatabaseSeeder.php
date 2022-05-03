<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        // \App\Models\User::factory(1)->create();
        Role::factory()->create([
            'role_name' => 'Admin'
        ]);
        Role::factory()->create([
            'role_name' => 'User'
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'asimsalus@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('4DZUvsnde5xkN828')
        ]);
        $this->command->info('Countries tables seeded!');
    }
}
