<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $roles = array_map('addTimestamp', array_values(config('enums.roles')));
        DB::table('roles')->insert($roles);

        // Super admin user
        DB::table('users')->insert(['name' => 'Super Admin', 'email' => 'super@admin.com', 'password' => bcrypt('123456'), 'phone' => NULL, 'phone' => '', 'cpf' => '1212121', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);
        DB::table('model_has_roles')->insert(['role_id' => config('enums.roles.SUPER_ADMIN.id'), 'model_type' => 'App\Models\User','model_id' => 1]);

        // Admin user
        DB::table('users')->insert(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('123456'), 'phone' => NULL,  'phone' => '', 'cpf' => '12121222', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);
        DB::table('model_has_roles')->insert(['role_id' => config('enums.roles.ADMIN.id'), 'model_type' => 'App\Models\User','model_id' => 2]);
    }
}
