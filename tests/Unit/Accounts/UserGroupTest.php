<?php

namespace Tests\Unit\Accounts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Accounts\UserGroupRepository;
use App\Accounts\UserGroup;
use App\Accounts\Role;
use DB;

class UserGroupTest extends TestCase
{
    private $repository;
    private $sample_model;
    
    public function setUp()
    {
        parent::setUp();
        $this->repository = new UserGroupRepository(new UserGroup());
        $this->sample_model = UserGroup::where("group_type", "!=", 0)->get()->sortBy("id")->first();
    }
    
    /**
     * @dataProvider userGroupDataProvider
     */
    public function testAddGroup($group, $flag)
    {
        $output = $this->repository->save($group);
        $this->assertEquals($flag, $output);
    }
    
    /**
     * @dataProvider userGroupDataProvider
     */
    public function testUpdateGroups($group, $add_flag, $update_flag = true)
    {
        $output = $this->repository->update($this->sample_model->id, $group);
        $this->assertEquals($update_flag, $output);
    }
    
    public function testUpdateGroupDoesnotExist()
    {
        $model = UserGroup::where("group_type", 0)->get()->first();
        $output = $this->repository->update($model->id, []);
        $this->assertEquals(false, $output);
    }
    
    public function testDeleteGroup()
    {
        $model = UserGroup::where("group_type", 1)->get()->sortBy("id")->first();
        $output = $this->repository->delete($model);
        
        $this->assertEquals(true, $output);
    }
    
    public function testDeleteRestrictedGroup()
    {
        $model = UserGroup::where("group_type", 0)->get()->sortBy("id")->first();
        $output = $this->repository->delete($model);
        
        $this->assertEquals(false, $output);
    }
    
    public function testUpdateRestrictedGroup()
    {
        $model = UserGroup::where("group_type", 0)->get()->sortBy("id")->first();
        $output = $this->repository->update($model->id, []);
        
        $this->assertEquals(false, $output);
    }
    
    public function testAddOneRoleForOneGroup()
    {
        $role = Role::where("role_type", "!=", 0)->get()->sortBy("id")->first();
        
        $group_role_matrix['groups'][] = $this->sample_model->id;
        $group_role_matrix['roles'][$this->sample_model->id][] = $role->id;
        $this->repository->saveGroupRoles($group_role_matrix);
        
        $this->sample_model->fresh();
        
        $result = $this->sample_model->roles()->where('id', $role->id)->get();
        $this->assertCount(1, $result);
    }
    
    public function testAddMultipleRolesForOneGroup()
    {
        $roles  = Role::take(10)->get();
        
        $group_role_matrix['groups'][] = $this->sample_model->id;
        
        foreach($roles as $role) {
            $group_role_matrix['roles'][$this->sample_model->id][] = $role->id;
        }
        
        $this->repository->saveGroupRoles($group_role_matrix);
        
        $this->sample_model->fresh();
        
        $result = $this->sample_model->roles()->find($group_role_matrix['roles'][$this->sample_model->id]);
        $this->assertCount(10, $result);
    }
    
    public function testRemoveOneRoleFromOneGroup() {
        $roles = $this->sample_model->roles->toArray();
        $removed_role = array_pop($roles);
        $group_role_matrix['groups'][] = $this->sample_model->id;
        $group_role_matrix['roles'][$this->sample_model->id] = array_column($roles, "id");
        $this->repository->saveGroupRoles($group_role_matrix);
        
        $this->sample_model->fresh();
        
        $new_roles = $this->sample_model->roles->toArray();
        
        $this->assertNotContains($removed_role['id'], $new_roles);
        
    }
    
    public function testRemoveAllRolesFromOneGroup()
    {
        $group_role_matrix['groups'][] = $this->sample_model->id;
        $this->repository->saveGroupRoles($group_role_matrix);
        $this->sample_model->fresh();
        $new_roles = $this->sample_model->roles->toArray();
        $this->assertEmpty($new_roles);
    }
    
    public function testAddRolesForMultipleGroups()
    {
        $roles     = Role::take(10)->get()->toArray();
        $groups    = UserGroup::take(5)->get();
        $roles_ids = array_column($roles, "id");
        foreach($groups as $group) {
            $group_role_matrix['groups'][] = $group->id;
            $group_role_matrix['roles'][$group->id] = $roles_ids;
        }
        
        $this->repository->saveGroupRoles($group_role_matrix);
        
        #load groups again
        $groups = UserGroup::find(array_column($groups->toArray(), "id"));
        
        foreach($groups as $group) {
            $roles = $group->roles->toArray();
            $current_roles = array_column($roles, "id");
            
            $this->assertEmpty(array_diff($roles_ids, $current_roles));
            
        }
        
    }
    
    public function testRemoveMultipleRolesFromMultipleGroups() {
        
        $removed_roles = array();
        
        $groups = UserGroup::take(5)->get();
        
        foreach($groups as $key => $group) {
            $roles = array_column($group->roles->toArray(), "id");
            
            if($key == 0) {
                $untouched_group = $group;
                $untouched_group_roles = $roles;
                continue;
            }
            
            $removed_roles[$group->id] = array_splice($roles, 0, 2);
            $group_role_matrix['groups'][] = $group->id;
            $group_role_matrix['roles'][$group->id] = $roles;
        }
        
        $this->repository->saveGroupRoles($group_role_matrix);
        
        $groups = UserGroup::take(5)->get();
        foreach($groups as $key => $group) {
            
            $current_roles = array_column($group->roles->toArray(), "id");
            
            if($key == 0) {
                $this->assertEquals($current_roles, $untouched_group_roles);
                continue;
            }
            
            $this->assertEquals(
                    array_diff($removed_roles[$group->id], $current_roles), 
                    $removed_roles[$group->id]
            );
        }
        
    }
    
    public function testRemoveAllRoles()
    {
        $groups = UserGroup::all()->toArray();
        $group_ids = array_column($groups, "id");
        $group_role_matrix['groups'] = $group_ids;
        $this->repository->saveGroupRoles($group_role_matrix);
        
        $count = DB::table('role_user_group')->count();
        
        $this->assertEquals(0, $count);
    }
    
    public function userGroupDataProvider()
    {
        return [
            "Valid role" => [["name" => "Group_" . uniqid(), "description" => 'bla bla bla'], true],
            "Missing role name" => [["description" => 'bla bla bla'], false, true],
            "Missing Description" => [["name"  => "Group_" . uniqid()], true],
        ];
    }
}
