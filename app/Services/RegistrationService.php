<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\Outlet;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\OutletRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class RegistrationService
{
    /**
     * Register new user, company and outlet.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    public function handleRegistration(array $data): User
    {
        // Create a new user
        $user = $this->registerNewUser($data);

        // Create a new company
        $company = $this->registerUserCompany($user, $data);

        // Create a new outlet for the company
        $this->registerCompanyOutlet($company, $data);

        // Bind the user to the company
        $user = $this->bindUserToCompany($user, $company);

        // Load user's relations
        $user->load(['company', 'outlet']);

        return $user;
    }

    /**
     * Register a new user.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    public function registerNewUser(array $data): User
    {
        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => UserRole::Admin->value,
            'outlet_id' => null, // Null, since the user is the owner and can access multiple outlets
        ];

        return app()->make(UserRepositoryInterface::class)->save($payload);
    }

    /**
     * Register user company.
     *
     * @param  \App\Models\User $user
     * @param  array $data
     * @return \App\Models\Company
     */
    public function registerUserCompany(User $user, array $data): Company
    {
        $payload = [
            'owner_id' => $user->id,
            'name' => $data['company_name'],
            'slug' => CompanyService::generateSlug($data['company_name']),
            'is_active' => 1,
        ];

        return app()->make(CompanyRepositoryInterface::class)->save($payload);
    }

    /**
     * Register company first outlet.
     *
     * @param  \App\Models\Company $company
     * @param  array $data
     * @return \App\Models\Outlet
     */
    public function registerCompanyOutlet(Company $company, array $data): Outlet
    {
        $payload = [
            'company_id' => $company->id,
            'name' => $data['outlet_name'],
            'address' => $data['outlet_address'],
            'phone' => $data['outlet_phone'],
        ];

        return app()->make(OutletRepositoryInterface::class)->save($payload);
    }

    /**
     * Bind user to company.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Company $company
     * @return \App\Models\User
     */
    public function bindUserToCompany(User $user, Company $company): User
    {
        $user->company_id = $company->id;
        $user->save();

        return $user;
    }
}
