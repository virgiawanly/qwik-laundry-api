<?php

namespace App\Services;

use App\Models\User;
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
    public function loginWebApp(array $data): array
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

    /**
     * Login mobile app by issuing token.
     *
     * @param  array $data
     * @return array
     */
    public function loginMobileApp(array $data): array
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
            'token' => $user->createToken('MobileAppToken')->plainTextToken
        ];
    }

    /**
     * Get current logged in user.
     *
     * @return \App\Models\User
     */
    public function getCurrentUser(): User
    {
        $user = User::with(['company', 'outlet'])
            ->where('id', auth()->user()->id)
            ->firstOrFail();

        return $user;
    }
}
