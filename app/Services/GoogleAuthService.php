<?php

namespace App\Services;

use App\Models\RegistrationToken;
use App\Models\User;
use Carbon\Carbon;
use Google_Client;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;

class GoogleAuthService
{
    /**
     * Authenticate Google token and generate access token or registration token.
     *
     * @param  array $payload
     * @return array
     */
    public function authenticateToken(array $payload): array
    {
        $idToken = $payload['token'] ?? null;

        // Check if token is provided
        if (empty($idToken)) {
            throw new UnauthorizedException(config('app.debug')
                ? trans('messages.token_is_required')
                : trans('messages.sorry_bad_request'));
        }

        // Initialize the Google client
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);

        // Get the token payload
        $tokenPayload = $client->verifyIdToken($idToken);

        // Check if token is valid
        if (empty($tokenPayload)) {
            throw new UnauthorizedException(config('app.debug')
                ? trans('messages.invalid_google_token')
                : trans('messages.sorry_bad_request'));
        }

        // Check if the user already exists
        $user = User::where('google_id', $tokenPayload['sub'])->orWhere('email', $tokenPayload['email'])->first();

        // If the user is already registered, return an access token
        if (!empty($user)) {
            $accessToken = $this->_generateAccessToken($user);

            return [
                'action' => 'login',
                'access_token' => $accessToken,
            ];
        }

        // Otherwise, generate a registration token for user to complete registration
        $registrationToken = $this->_generateRegistrationToken($tokenPayload);

        return [
            'action' => 'register',
            'registration_token' => $registrationToken,
        ];
    }

    /**
     * Get the access token for the user.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    private function _generateAccessToken(User $user): string
    {
        return $user->createToken('LaravelAuthApp')->plainTextToken;
    }

    /**
     * Store the registration token in the database.
     *
     * @param  array  $tokenPayload
     * @return string
     */
    private function _generateRegistrationToken(array $tokenPayload): string
    {
        $token = Str::random(60);

        RegistrationToken::create([
            'email' => $tokenPayload['email'],
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(30),
            'payload' => json_encode([
                'google_id' => $tokenPayload['sub'],
                'name' => $tokenPayload['name'],
                'picture' => $tokenPayload['picture'],
            ]),
        ]);

        return $token;
    }
}
