<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends BaseResourceRepository implements CustomerRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Customer();
    }
}
