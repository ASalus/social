<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_name' => 'Admin',
                'created_at' => '2022-02-18 07:46:34',
                'updated_at' => '2022-02-18 07:46:34',
            ),
            1 => 
            array (
                'id' => 2,
                'role_name' => 'User',
                'created_at' => '2022-02-18 07:46:42',
                'updated_at' => '2022-02-18 07:46:42',
            ),
        ));
        
        
    }
}