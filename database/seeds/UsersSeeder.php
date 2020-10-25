<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Админ
        User::create([
            'name' => 'Админ',
            'email' => 'admin@worksheet.test',
            'password' => Hash::make('123'),
        ]);
        // Руководитель филиала
        User::create([
            'name' => 'Руководитель Филиала',
            'email' => 'head@worksheet.test',
            'password' => Hash::make('123'),
            'filial_id' => rand(1,4)
        ]);
        // Пользователь
        User::create([
            'name' => 'Пользователь',
            'email' => 'user@worksheet.test',
            'password' => Hash::make('123'),
            'filial_id' => rand(1,4)
        ]);
    }
}
