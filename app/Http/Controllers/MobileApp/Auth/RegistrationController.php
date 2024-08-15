<?php

namespace App\Http\Controllers\MobileApp\Auth;

use App\Exceptions\ValidationException;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MobileApp\Auth\GoogleRegistrationRequest;
use App\Http\Requests\MobileApp\Auth\RegistrationRequest;
use App\Http\Requests\MobileApp\Auth\ValidateAccountRegistrationRequest;
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
     * Validate account registration.
     *
     * @param  \App\Http\Requests\MobileApp\Auth\ValidateAccountRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function validateAccountRegistration(ValidateAccountRegistrationRequest $request)
    {
        try {
            $this->registrationService->validateAccountRegistration($request->validated());
            return ResponseHelper::success('Account registration validated successfully', $request->only('name', 'email'));
        } catch (ValidationException $e) {
            return ResponseHelper::validationError($e->getMessage());
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\MobileApp\Auth\RegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->registrationService->handleRegistration($request->validated());
            DB::commit();
            return ResponseHelper::success('User created successfully', $result, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\MobileApp\Auth\GoogleRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function registerGoogle(GoogleRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->registrationService->handleGoogleRegistration($request->validated());
            DB::commit();
            return ResponseHelper::success('User created successfully', $result, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
