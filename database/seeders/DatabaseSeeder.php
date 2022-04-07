<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        Role::factory()->create([
            'role_name' => 'Admin'
        ]);
        Role::factory()->create([
            'role_name' => 'User'
        ]);
        $this->call('ImportCoutiesTable');
        $this->command->info('Countries tables seeded!');
    }
}
