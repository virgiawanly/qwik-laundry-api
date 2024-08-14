<?php

namespace App\Http\Controllers\MobileApp\Customer;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\MobileApp\Customer\CreateCustomerRequest;
use App\Http\Requests\MobileApp\Customer\UpdateCustomerRequest;
use App\Services\CustomerService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected CustomerService $customerService)
    {
        parent::__construct($customerService->repository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\Customer\CreateCustomerRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCustomerRequest $request)
    {
        try {
            $result = $this->customerService->save($request->validated());
            return ResponseHelper::success(trans('messages.successfully_created'), $result, 201);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\Customer\UpdateCustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCustomerRequest $request, int $id)
    {
        try {
            $result = $this->customerService->patch($id, $request->validated());
            return ResponseHelper::success(trans('messages.successfully_updated'), $result, 200);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound(trans('messages.resource_not_found'), $e);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
