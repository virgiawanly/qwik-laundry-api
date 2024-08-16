<?php

namespace App\Repositories;

use App\Models\AddOn;
use App\Repositories\Interfaces\AddOnRepositoryInterface;

class AddOnRepository extends BaseResourceRepository implements AddOnRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new AddOn();
    }
}
