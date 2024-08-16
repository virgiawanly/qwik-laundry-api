<?php

namespace App\Http\Controllers\WebApp\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\GoogleAuthService;
use Exception;
use Illuminate\Http\Request;
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
     * Authenticate Google token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        try {
            $result = $this->googleAuthService->authenticateToken($request->validated());
            return ResponseHelper::data($result);
        } catch (UnauthorizedException $e) {
            return ResponseHelper::unauthorized($e->getMessage());
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
