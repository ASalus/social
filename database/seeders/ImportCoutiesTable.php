<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportCoutiesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'storage/app/dev_docs/sql/world.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Country table seeded!');
    }
}
