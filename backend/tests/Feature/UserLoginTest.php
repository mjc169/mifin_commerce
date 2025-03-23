<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    public $token;

    protected function setUp(): void
    {
        parent::setUp();

        $userData = [
            'email' => 'mifin@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $userData);
        $response->assertStatus(200);

        $responseData = $response->json();
        $this->token = $responseData['token'];

        $this->assertNotEmpty($this->token);
    }

    //use RefreshDatabase; TODO: enable when re-seeding can be run after this.
    public function test_Api_Url_status_ok()
    {
        $response = $this->get('/api');
        $response->assertStatus(200);
    }

    public function test_get_user_information()
    {
        // Now you can use the $token in subsequent requests
        $requestHeader = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->withHeaders($requestHeader)
            ->get('/api/userInformation');

        $response->assertStatus(200);
        $responseData = $response->json();
        $this->assertEquals('mifin@example.com', $responseData['email']);
        $this->assertEquals('Mifin User', $responseData['name']);
        $this->assertEquals(1000.00, $responseData['balance']);
    }
}
