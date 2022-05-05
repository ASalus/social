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
        Role::firstOrCreate([
            'id' => 1,
            'role_name' => 'Admin'
        ]);
        Role::firstOrCreate([
            'id' => 2,
            'role_name' => 'User'
        ]);
        User::firstOrCreate([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'ex@gmail.com', // This data been changed for safety reason
            'role_id' => 1,
            'password' => Hash::make('12345678') // This data been changed for safety reason
        ]);
        $this->command->info('Countries tables seeded!');
    }
}
