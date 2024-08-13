<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Str;

class CompanyService extends BaseResourceService
{
    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Interfaces\CompanyRepositoryInterface  $companyRepository
     * @return void
     */
    public function __construct(protected CompanyRepositoryInterface $companyRepository)
    {
        parent::__construct($companyRepository);
    }

    /**
     * Generate a unique slug for the company.
     *
     * @param  string $name
     * @return string
     */
    public static function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;

        // Check if the slug already exists in the Company model
        $counter = 1;
        while (Company::where('slug', $slug)->exists()) {
            // Append the counter to the slug if it already exists
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
