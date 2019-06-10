<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $user = new User([
            'email' => 'test@email.com',
            'password' => '123456'
        ]);

        $user->save();
    }

    /** @test */
    public function it_will_register_a_user(): void
    {
        $response = $this->post('api/register', [
            'email' => 'test2@email.com',
            'password' => '123456',
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_will_log_a_user_in(): void
    {
        $response = $this->post('api/login', [
            'email' => 'test@email.com',
            'password' => '123456',
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    /** @test */
    public function it_will_not_log_an_invalid_user_in(): void
    {
        $response = $this->post('api/login', [
            'email' => 'test@email.com',
            'password' => 'notlegitpassword',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}