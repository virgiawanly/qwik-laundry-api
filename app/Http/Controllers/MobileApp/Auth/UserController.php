<?php

namespace App\Http\Controllers\MobileApp\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\AuthService  $authService
     * @return void
     */
    public function __construct(protected AuthService $authService) {}

    /**
     * Get current logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentUser()
    {
        try {
            $result = $this->authService->getCurrentUser();
            return ResponseHelper::data($result);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::unauthorized();
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
