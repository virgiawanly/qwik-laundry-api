<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface extends BaseResourceRepositoryInterface
{
    /**
     * Find user by email.
     *
     * @param  string $email
     * @return \App\Models\User|null
     */
    public function findUserByEmail(string $email): ?User;
}
