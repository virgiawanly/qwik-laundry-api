<?php

namespace App\Http\Controllers\MobileApp\ProductType;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\MobileApp\ProductType\CreateProductTypeRequest;
use App\Http\Requests\MobileApp\ProductType\UpdateProductTypeRequest;
use App\Services\ProductTypeService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductTypeController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ProductTypeService $productTypeService)
    {
        parent::__construct($productTypeService->repository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\ProductType\CreateProductTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductTypeRequest $request)
    {
        try {
            $result = $this->productTypeService->save($request->validated());
            return ResponseHelper::success(trans('messages.successfully_created'), $result, 201);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\ProductType\UpdateProductTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductTypeRequest $request, int $id)
    {
        try {
            $result = $this->productTypeService->patch($id, $request->validated());
            return ResponseHelper::success(trans('messages.successfully_updated'), $result, 200);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound(trans('messages.resource_not_found'), $e);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
