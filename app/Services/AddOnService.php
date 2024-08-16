<?php

namespace App\Services;

use App\Repositories\Interfaces\AddOnRepositoryInterface;

class AddOnService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\AddOnRepositoryInterface  $addonRepository
     * @return void
     */
    public function __construct(protected AddOnRepositoryInterface $addonRepository)
    {
        parent::__construct($addonRepository);
    }

    /**
     * Get the repository instance.
     *
     * @return \App\Repositories\Interfaces\AddOnRepositoryInterface
     */
    public function repository(): AddOnRepositoryInterface
    {
        return $this->addonRepository;
    }
}
