<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start: Reset roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $tableNames = config('permission.table_names');
        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        collect($tableNames)->map(function ($table) {
            DB::table($table)->truncate();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        // End: Reset roles and permissions

        // create permissions
        Permission::create(['name' => 'manage heads']);
        Permission::create(['name' => 'manage users']);

        Permission::create(['name' => 'delete worksheets']);

        $admin = Role::create(['name' => 'admin', 'title'=>'Администратор']);
        $admin->givePermissionTo(Permission::all());

        $head = Role::create(['name' => 'head', 'title' => 'Руководитель филиала']);
        $head->givePermissionTo(['manage users', 'delete worksheets']);

        $user = Role::create(['name' => 'user', 'title' => 'Пользователь']);
        $user->givePermissionTo(['']);

        User::findOrFail(1)->assignRole($admin); // Админ
        User::findOrFail(2)->assignRole($head); // Руководитель филиала
        User::findOrFail(3)->assignRole($user); // Пользователь
    }
}
