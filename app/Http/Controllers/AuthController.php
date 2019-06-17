<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $user = User::create([
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $token = \auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = \request(['email', 'password']);

        if (! $token = \auth()->attempt($credentials)) {
            return \response()->json([], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        \auth()->logout();

        return \response()->json();
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return \response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
