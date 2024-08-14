<?php

namespace App\Traits;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

trait ScopedByCompany
{
    /**
     * Boot the scoped user company.
     */
    protected static function bootScopedByCompany(): void
    {
        // Add global scope for query
        static::addGlobalScope(new CompanyScope);

        // Auto fill company id on create new model
        static::creating(function (Model $model) {
            if (auth()->check()) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    /**
     * Disable the company scope.
     */
    public static function withoutCompanyScope(): mixed
    {
        return (new static)->newQueryWithoutScope(new CompanyScope);
    }
}
