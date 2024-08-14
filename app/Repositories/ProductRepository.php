<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseResourceRepository implements ProductRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Product();
    }
}
