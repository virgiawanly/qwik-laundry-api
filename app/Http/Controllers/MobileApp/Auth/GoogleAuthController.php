<?php

namespace App\Http\Controllers\MobileApp\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MobileApp\Auth\GoogleLoginRequest;
use App\Services\GoogleAuthService;
use Exception;
use Illuminate\Validation\UnauthorizedException;

class GoogleAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\GoogleAuthService  $googleAuthService
     * @return void
     */
    public function __construct(protected GoogleAuthService $googleAuthService) {}

    /**
     * Authenticate a Google token.
     *
     * @param  \App\Http\Requests\MobileApp\Auth\GoogleLoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(GoogleLoginRequest $request)
    {
        try {
            $result = $this->googleAuthService->authenticateToken($request->all());
            return ResponseHelper::data($result);
        } catch (UnauthorizedException $e) {
            return ResponseHelper::unauthorized($e->getMessage());
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
