<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\UserRepositoryInterface  $repository
     * @return void
     */
    public function __construct(protected UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
