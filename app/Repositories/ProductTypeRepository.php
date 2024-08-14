<?php

namespace App\Repositories;

use App\Models\ProductType;
use App\Repositories\Interfaces\ProductTypeRepositoryInterface;

class ProductTypeRepository extends BaseResourceRepository implements ProductTypeRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new ProductType();
    }
}
