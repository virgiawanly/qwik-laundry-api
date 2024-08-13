<?php

namespace App\Services;

use App\Repositories\Interfaces\OutletRepositoryInterface;

class OutletService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\OutletRepositoryInterface  $outletRepository
     * @return void
     */
    public function __construct(protected OutletRepositoryInterface $outletRepository)
    {
        parent::__construct($outletRepository);
    }
}
