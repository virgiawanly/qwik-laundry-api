<?php

namespace App\Http\Controllers\WebApp\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebApp\Auth\LoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\AuthService  $authService
     * @return void
     */
    public function __construct(protected AuthService $authService) {}

    /**
     * Login web app by issuing token.
     *
     * @param  \App\Http\Requests\WebApp\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->loginWebApp($request->validated());
            return ResponseHelper::data($result);
        } catch (UnauthorizedException $e) {
            return ResponseHelper::unauthorized($e->getMessage(), $e);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Logout web app by removing token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return ResponseHelper::success(trans('messages.logout_successful'));
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
