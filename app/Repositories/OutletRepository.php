<?php

namespace App\Repositories;

use App\Models\Outlet;
use App\Repositories\Interfaces\OutletRepositoryInterface;

class OutletRepository extends BaseResourceRepository implements OutletRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Outlet();
    }
}
