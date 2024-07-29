<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\CompanyRepositoryInterface  $repository
     * @return void
     */
    public function __construct(protected CompanyRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
