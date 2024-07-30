<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AuthService
{
    /**
     * Login web app by issuing token.
     *
     * @param  array $data
     * @return array
     */
    public function loginWebApp(array $data)
    {
        // Find user
        $user = app()->make(UserRepositoryInterface::class)->findUserByEmail($data['email']);

        // Validate credentials
        if (empty($user) || !Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedException('Invalid email or password');
        }

        // Load user's relations
        $user->load(['company', 'outlet']);

        return [
            'user' => $user,
            'token' => $user->createToken('WebAppToken')->plainTextToken
        ];
    }
}
