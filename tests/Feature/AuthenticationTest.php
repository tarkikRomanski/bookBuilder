<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /** @var User */
    private $user;

    /**
     * Processes before the tests run
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @group users-auth
     */
    public function testItWillRegisterAUser(): void
    {
        $response = $this->json(
            'POST',
            'api/register',
            [
                'email' => 'test2@email.com',
                'password' => 'secret',
            ]
        );

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @group users-auth
     */
    public function testValidationOfUniqueEmailRegistration(): void
    {
        $response = $this->json(
            'POST',
            'api/register',
            [
                'email' => $this->user->email,
                'password' => 'secret',
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('email')
            ->assertJsonFragment([
                'email' => ['The email has already been taken.'],
            ]);
    }

    /**
     * @group users-auth
     */
    public function testValidationOfInvalidEmailRegistration(): void
    {
        $response = $this->json(
            'POST',
            'api/register',
            [
                'email' => 'INVALID_EMAIL',
                'password' => 'secret',
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('email')
            ->assertJsonFragment([
                'email' => ['The email must be a valid email address.'],
            ]);
    }

    /**
     * @group users-auth
     */
    public function testValidationOfInvalidPasswordRegistration(): void
    {
        $response = $this->json(
            'POST',
            'api/register',
            [
                'email' => 'test@email.com',
                'password' => 'IP',
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('password')
            ->assertJsonFragment([
                'password' => ['The password must be at least 6 characters.'],
            ]);
    }

    /**
     * @group users-auth
     */
    public function testItWillLogAUserIn(): void
    {
        $response = $this->json(
            'POST',
            'api/login',
            [
                'email' => $this->user->email,
                'password' => 'secret',
            ]
        );

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    /**
     * @group users-auth
     */
    public function testItWillNotLogAnInvalidUserIn(): void
    {
        $response = $this->json(
            'POST',
            'api/login',
            [
                'email' => $this->user->email,
                'password' => 'NOT_VALID_PASSWORD',
            ]
        );

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
