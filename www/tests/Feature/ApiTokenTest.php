<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTokenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testToken()
    {
			$response = $this->json('POST', '/api/login', ['email' => 'admin@admin.com', 'password' => 'adminadmin']);

			$response
					->assertStatus(200)
					->assertJson([
							'token_type' => 'bearer',
					]);
    }
}
