<?php

namespace Tests\Unit\Accounts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Accounts\RoleRepository;
use App\Accounts\Role;

class RolesTest extends TestCase
{
    
    private $repository;
    private $sample_model;
    
    public function setUp()
    {
        parent::setUp();
        $this->repository = new RoleRepository(new Role());
        $this->sample_model = Role::where("role_type", "!=", 0)->get()->sortBy("id")->first();
    }
    
    /**
     * @dataProvider roleDataProvider
     */
    public function testSaveRoles($role, $flag)
    {
        $output = $this->repository->save($role);
        $this->assertEquals($flag, $output);
    }
    
    /**
     * @dataProvider roleDataProvider
     */
    public function testUpdateRoles($role, $add_flag, $update_flag = true)
    {
        $output = $this->repository->update($this->sample_model->id, $role);
        $this->assertEquals($update_flag, $output);
    }
    
    public function testEditReservedRoles()
    {
        $model = Role::where("role_type", 0)->get()->sortBy("id")->first();
        $output = $this->repository->update($model->id, []);
        
        $this->assertEquals(false, $output);
    }
    
    public function testDeleteReservedRoles()
    {
        $model = Role::where("role_type", 0)->get()->sortBy("id")->first();
        $output = $this->repository->delete($model);
        
        $this->assertEquals(false, $output);
    }
    
    public function roleDataProvider()
    {
        return [
            "Valid role" => [["name" => "Role_" . uniqid(), "description" => 'bla bla bla'], true],
            "Duplicate role name" => [["name" => "Edit Roles", "description" => 'bla bla bla'], false, false],
            "Missing role name" => [["description" => 'bla bla bla'], false, true],
            "Missing Description" => [["name"  => "Role_" . uniqid()], true],
        ];
    }
}
