<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->insert([
            'name' => 'Super Admin'
        ]);
        
        DB::table('user_groups')->insert([
            'name' => 'Test Group'
        ]);
        
        DB::table('roles')->insert([
            'name' => 'Test Role'
        ]);
        
        DB::table('role_user_group')->insert([
            'role_id' => 1,
            'user_group_id' => 2
        ]);
        
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'user_group_id' => 1,
            'status' => 1,
            'password' => bcrypt('password'),
        ]);
    }
}
