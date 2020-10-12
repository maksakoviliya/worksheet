<?php

use App\Filial;
use Illuminate\Database\Seeder;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('filials')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Filial::create([
            'name' => 'Йошкар-Ола',
            'city' => 'Йошкар-Ола'
        ]);
        Filial::create([
            'name' => 'Казань',
            'city' => 'Казань'
        ]);
        Filial::create([
            'name' => 'Москва (Кириллов)',
            'city' => 'Москва'
        ]);
        Filial::create([
            'name' => 'Москва (Болотин)',
            'city' => 'Москва'
        ]);
        Filial::create([
            'name' => 'Ульяновск',
            'city' => 'Ульяновск'
        ]);
        Filial::create([
            'name' => 'Нижний Новгород',
            'city' => 'Нижний Новгород'
        ]);
        Filial::create([
            'name' => 'Чебоксары',
            'city' => 'Чебоксары'
        ]);
    }
}
