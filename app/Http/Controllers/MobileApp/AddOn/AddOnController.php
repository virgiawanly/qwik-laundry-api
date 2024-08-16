<?php

namespace App\Http\Controllers\MobileApp\AddOn;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\MobileApp\AddOn\CreateAddOnRequest;
use App\Http\Requests\MobileApp\AddOn\UpdateAddOnRequest;
use App\Services\AddOnService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddOnController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected AddOnService $addOnService)
    {
        parent::__construct($addOnService->repository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\AddOn\CreateAddOnRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAddOnRequest $request)
    {
        try {
            $result = $this->addOnService->save($request->validated());
            return ResponseHelper::success(trans('messages.successfully_created'), $result, 201);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\AddOn\UpdateAddOnRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAddOnRequest $request, int $id)
    {
        try {
            $result = $this->addOnService->patch($id, $request->validated());
            return ResponseHelper::success(trans('messages.successfully_updated'), $result, 200);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound(trans('messages.resource_not_found'), $e);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
