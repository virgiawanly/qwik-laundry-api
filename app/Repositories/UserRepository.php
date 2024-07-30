<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseResourceRepository implements UserRepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Find user by email.
     *
     * @param  string $email
     * @return \App\Models\User|null
     */
    public function findUserByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
