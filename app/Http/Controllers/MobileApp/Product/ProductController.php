<?php

namespace App\Http\Controllers\MobileApp\Product;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\MobileApp\Product\CreateProductRequest;
use App\Http\Requests\MobileApp\Product\UpdateProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ProductService $productService)
    {
        parent::__construct($productService->repository());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\Product\CreateProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $result = $this->productService->save($request->validated());
            return ResponseHelper::success(trans('messages.successfully_created'), $result, 201);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $result = $this->productService->find($id, ['productType']);
            return ResponseHelper::data($result);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound(trans('messages.resource_not_found'));
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MobileApp\Product\UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $result = $this->productService->patch($id, $request->validated());
            return ResponseHelper::success(trans('messages.successfully_updated'), $result, 200);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound(trans('messages.resource_not_found'), $e);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), $e);
        }
    }
}
