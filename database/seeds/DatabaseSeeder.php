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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Shashank Shekhar',
            'email' => 'shashank@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('roles')->insert([
        	'name' => 'admin',
        	'display_name' => 'He is an admin',
        	'description' => 'Manage all activities',
        ]);

        DB::table('roles')->insert([
        	'name' => 'manager',
        	'display_name' => 'He is a manager',
        	'description' => 'Manage everything',
        ]);

        DB::table('roles')->insert([
        	'name' => 'user',
        	'display_name' => 'He is a user',
        	'description' => 'use most of the things',
        ]);

        DB::table('permissions')->insert([
        	'name' => 'create',
        	'display_name' => 'create',
        	'description' => 'super',
        ]);

        DB::table('permissions')->insert([
        	'name' => 'Update',
        	'display_name' => 'Update',
        	'description' => 'Update records',
        ]);

        DB::table('role_user')->insert([
        	'user_id' => '1',
        	'role_id' => '1',
        ]);

        DB::table('permission_role')->insert([
        	'permission_id' => '1',
        	'role_id' => '1',
        ]);
    }
}
