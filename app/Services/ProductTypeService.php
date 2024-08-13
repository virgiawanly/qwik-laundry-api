<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductTypeRepositoryInterface;

class ProductTypeService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\ProductTypeRepositoryInterface  $productTypeRepository
     * @return void
     */
    public function __construct(protected ProductTypeRepositoryInterface $productTypeRepository)
    {
        parent::__construct($productTypeRepository);
    }

    /**
     * Get the repository instance.
     *
     * @return \App\Repositories\Interfaces\ProductTypeRepositoryInterface
     */
    public function repository(): ProductTypeRepositoryInterface
    {
        return $this->productTypeRepository;
    }
}
