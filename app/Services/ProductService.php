<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\ProductRepositoryInterface  $productRepository
     * @return void
     */
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
        parent::__construct($productRepository);
    }

    /**
     * Get the repository instance.
     *
     * @return \App\Repositories\Interfaces\ProductRepositoryInterface
     */
    public function repository(): ProductRepositoryInterface
    {
        return $this->productRepository;
    }
}
