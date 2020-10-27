<?php

use App\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('banks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Bank::create([
            'name' => 'Сбер'
        ]);
        Bank::create([
            'name' => 'Тинькоf'
        ]);
        Bank::create([
            'name' => 'ВТБ'
        ]);
        Bank::create([
            'name' => 'Райфайзен'
        ]);
        Bank::create([
            'name' => 'Точка'
        ]);
    }
}
