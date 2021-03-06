<?php

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
        $this->call(FilialSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(BanksSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
        $this->call(WorksheetsSeeder::class);
    }
}
