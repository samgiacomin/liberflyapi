<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */


    public function test_root(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        
        $response = $this->post('/api/login', ['email' => 'user@gmail.com', 'password' => '123456']);
      
       
        $response->assertStatus(200);
    }

    public function test_tasks()
    {
        
        $response = $this->post('/api/login', ['email' => 'user@gmail.com', 'password' => '123456']);
        //  print_r( $response);
        $token = $response['access_token'];

        $ret = $this->withHeader('Authorization', 'Bearer ' . $token)->json('get', '/api/tasks');
       
        $ret->assertStatus(200);
    }

    public function test_task()
    {
        
        $response = $this->post('/api/login', ['email' => 'user@gmail.com', 'password' => '123456']);
        //  print_r( $response);
        $token = $response['access_token'];

        $ret = $this->withHeader('Authorization', 'Bearer ' . $token)->json('get', '/api/tasks/1');
       
        $ret->assertStatus(200);
    }
}
