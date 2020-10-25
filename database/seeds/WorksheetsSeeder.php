<?php

use App\Worksheet;
use Illuminate\Database\Seeder;

class WorksheetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('worksheets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        factory(App\Worksheet::class, 12)->create();
    }
}
