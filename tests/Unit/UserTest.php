<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Accounts\UserRepository;
use App\Accounts\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    private $repository;
    private $sample_model;
    
    public function setUp()
    {
        parent::setUp();
        $this->repository = new UserRepository(new User());
        $this->sample_model = User::all()->sortByDesc("email")->first();
    }
    
    /**
     * @dataProvider userDataProvider
     */
    public function testCanAddUser($user, $add_flag)
    {
        $output = $this->repository->save($user);
        $this->assertEquals($add_flag, $output);
        
        if($add_flag) {
            $this->assertTrue(Hash::check($user['password'], $this->repository->getModel()->password),
                "Assert that the hashed password matched the provided password");
        }
    }
    
    /**
     * @dataProvider userDataProvider
     */
    public function testCanUpdateUser($user, $add_flag, $update_flag = true)
    {
        $output = $this->repository->update($this->sample_model->id, $user);
        $this->assertEquals($update_flag, $output);
        
        if($update_flag && !empty($user['password'])) {
            $this->assertTrue(Hash::check($user['password'], $this->repository->getModel()->password),
                "Assert that the hashed password matched the provided password");
        }
    }
    
    public function userDataProvider()
    {
        $email = $this->unique_email();
        return [
            "Valid User" => [[
                    "name"  => "TestUser", "email" => $email,
                    "user_group_id" => 1, "status" => 1, "password" => uniqid()
                ], true],
            "User without password" => [[
                    "name"  => "TestUser", "email" => $this->unique_email(),
                    "user_group_id" => 1, "status" => 1
                ], false],
            "User without name" => [[
                    "email" => $this->unique_email(),
                    "user_group_id" => 1, "status" => 1, "password" => uniqid()
                ], false],
            "User without email" => [[
                    "name"  => "TestUser",
                    "user_group_id" => 1, "status" => 1, "password" => uniqid()
                ], false],
            "User without groupid" => [[
                    "name"  => "TestUser", "email" => $this->unique_email(),
                    "status" => 1, "password" => uniqid()
                ], false],
            "User without status" => [[
                    "name"  => "TestUser", "email" => $this->unique_email(),
                    "user_group_id" => 1, "password" => uniqid()
                ], true],
            "User with duplicate email address" => [[
                    "name"  => "TestUser", "email" => "admin@gmail.com",
                    "user_group_id" => 1, "status" => 1, "password" => uniqid()
                ], false, false],
            "User with invalid status" => [[
                    "name"  => "TestUser", "email" => $this->unique_email(),
                    "user_group_id" => 1, "status" => -1, "password" => uniqid()
                ], false, false],
            "User with invalid group id" => [[
                    "name"  => "TestUser", "email" => $this->unique_email(),
                    "user_group_id" => -1, "status" => 1, "password" => uniqid()
                ], false, false]
        ];
    }
    
    private function unique_email()
    {
        return "test" . uniqid() . rand() . "@hotmail.com";
    }
}
