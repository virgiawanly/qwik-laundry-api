<?php

namespace App\Services;

use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\CustomerRepositoryInterface  $customerRepository
     * @return void
     */
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
        parent::__construct($customerRepository);
    }

    /**
     * Get the repository instance.
     *
     * @return \App\Repositories\Interfaces\CustomerRepositoryInterface
     */
    public function repository(): CustomerRepositoryInterface
    {
        return $this->customerRepository;
    }
}
