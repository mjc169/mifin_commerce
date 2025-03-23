<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    //use RefreshDatabase; TODO: enable when re-seeding can be run after this.
    public function test_api_status_ok()
    {
        $response = $this->get('/api');
        $response->assertStatus(200); // Ensure the request was successful.
    }

    /* TODO: modify this when login route has been established
    public function test_user_record_not_empty()
    {
        $response = $this->get('/api/user');

        $response->assertStatus(200); // Ensure the request was successful.
        $response->assertJsonCount(10); // Assert that the JSON array has 10 elements.
    }

    public function test_user_can_login()
    {
        $userData = [
            'email' => 'mifin@example.com',
            'password' => 'password'
        ];

        $response = $this->get('/api/user/1', $userData);
        $response->assertStatus(200);
        //$this->assertAuthenticated();
    } */
}
