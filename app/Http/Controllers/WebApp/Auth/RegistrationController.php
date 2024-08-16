<?php

namespace App\Http\Controllers\WebApp\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebApp\Auth\GoogleRegistrationRequest;
use App\Http\Requests\WebApp\Auth\RegistrationRequest;
use App\Services\RegistrationService;
use Exception;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\RegistrationService  $registrationService
     * @return void
     */
    public function __construct(protected RegistrationService $registrationService) {}

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\WebApp\Auth\RegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->registrationService->handleRegistration($request->validated());
            DB::commit();
            return ResponseHelper::success(trans('messages.successfully_registered'), $result, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\WebApp\Auth\GoogleRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function registerGoogle(GoogleRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->registrationService->handleGoogleRegistration($request->validated());
            DB::commit();
            return ResponseHelper::success(trans('messages.successfully_registered'), $result, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
