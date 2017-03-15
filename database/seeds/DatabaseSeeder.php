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
            'name' => 'Super Admin',
            'group_type' => 0
        ]);
        
        DB::table('user_groups')->insert([
            'name' => 'Test Group'
        ]);
        
        DB::table('roles')->insert([
            'name' => 'Test Role',
            'role_type' => 0
        ]);
        
        DB::table('roles')->insert([
            'name' => 'Test user defined role'
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
        
        DB::table('connection_types')->insert([
            'name' => 'MySQL',
        ]);
        DB::table('connection_types')->insert([
            'name' => 'Oracle',
        ]);
        DB::table('connection_types')->insert([
            'name' => 'MSSQL',
        ]);
        DB::table('connection_types')->insert([
            'name' => 'PostgreSQL',
        ]);
        
        DB::table('connections')->insert([
            'name' => 'local',
            'connection_type_id' => '1',
            'host' => '127.0.0.1',
            'user' => 'shaer1',
            'password' => '',
        ]);
    }
}

