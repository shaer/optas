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
        
        $roles = [
                    "View Users","Add Users","Edit Users","Delete Users","View UserGroups",
                    "Add UserGroups","Edit UserGroups","Delete UserGroups",
                    "Assign Roles To UserGroups", "View Assigned Roles To UserGroups",
                    "View Roles","Add Roles","Edit Roles","Delete Roles","View Connections",
                    "Add Connections","Edit Connections","Delete Connections",
                    "View Jobs","Add Jobs","Edit Jobs","Delete Jobs"
                ];
        
        foreach($roles as $role) {
             DB::table('roles')->insert([
                    "name"         => $role,
                    "machine_name" => Helper::tokenize($role),
                    'role_type'    => 0
                 ]);
        }
        
        DB::insert('insert into role_user_group (user_group_id, role_id)
                    SELECT 1, id FROM roles    
        ');
        
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
        
        DB::table('action_types')->insert([
            'name' => 'Database Query',
        ]);
        
        DB::table('connections')->insert([
            'name' => 'local',
            'connection_type_id' => '1',
            'host' => '127.0.0.1',
            'user' => 'shaer1',
            'password' => '',
        ]);
        
        
        DB::table('jobs')->insert([
            'name' => 'Test Report',
            'namespace' => 'com.test.report',
            'created_by' => 1,
        ]);
        
        DB::table('actions')->insert([
            'action_type_id' => 1,
            'job_id'        => 1,
            'triggerable_id'  => 1,
            'triggerable_type'  => 'DbAction'
        ]);
        
        DB::table('db_actions')->insert([
            'query'         => "Select * from table;",
            'is_csv'        => 'T',
            'connection_id' => 1,
        ]);
    }
}

