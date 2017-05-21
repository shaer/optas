<?php

namespace Tests\Unit\Connections;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Connections\Connection;
use App\Connections\ConnectionRepository;
use Illuminate\Support\Facades\Crypt;
use App\Core\Exceptions\EntityNotFoundException;


class ConnectionTest extends TestCase
{
    private $repository;
    private $sample_model;
    
    public function setUp()
    {
        parent::setUp();
        $this->repository = new ConnectionRepository(new Connection());
        
        $this->sample_model = Connection::all()->first();
    }
    
    /**
     * @dataProvider addConnectionDataProvider
     */
    public function testAddingConnections($connection, $add_flag)
    {
        $output = $this->repository->save($connection);
        $this->assertEquals($add_flag, $output);
        
        if($add_flag) {
            
            $password = $this->repository->getModel()->password;

            if(empty($connection['password'])) {
                $this->assertEquals($password, null, "Making sure that empty password hasn't been hashed");
            } else {
                $this->assertEquals(Crypt::decryptString($password), $connection['password'], 
                        "Making Sure that the encrypted password can be decrypted successfully");

            }
        }
    }
    
    /**
     * @dataProvider addConnectionDataProvider
     */
    public function testUpdatingConnection($connection, $add_flag, $update_flag = true)
    {
        $output = $this->repository->update($this->sample_model->id, $connection);
        $this->assertEquals($update_flag, $output);
    }
    
    public function testUpdateConnectionThatDoesnotExist()
    {
        $this->expectException(EntityNotFoundException::class);
        $this->repository->update(-50, []);
    }
    
    public function addConnectionDataProvider(){
        return [
            "Check valid connection" => [[ "name" => "Test Connection", "connection_type_id" => 1, 
                    "host" => "localhost", "user" => "test_user", "password" => uniqid()], true],

            "Check valid connection with empty password" => [[ "name" => "Test Connection", 
                    "connection_type_id" => 1, "host" => "localhost",  "user" => "test_user"], true],

            "Check Missing name" => [[ "connection_type_id" => 1, "host" => "localhost", 
                    "user" => "test_user", "password" => uniqid()], false],

            "Check Missing connection type ID" => [[ "name" => "Test Connection", "host" => "localhost", 
                    "user" => "test_user", "password" => uniqid()], false],

            "Check Invalid connection type id" => [[ "name" => "Test Connection", "connection_type_id" => 999, 
                    "host" => "localhost", "user" => "test_user", "password" => uniqid()], false, false],

            "Check Missing Hostname" => [[ "name" => "Test Connection", "connection_type_id" => 1, 
                    "user" => "test_user", "password" => uniqid()], false],

            "Check Missing username" => [[ "name" => "Test Connection", "connection_type_id" => 1, 
                    "host" => "localhost", "password" => uniqid()], false],
        ];
    }
}
