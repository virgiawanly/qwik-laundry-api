<?php

namespace App\Traits;

use App\Models\Scopes\OutletScope;
use Illuminate\Database\Eloquent\Model;

trait ScopedByOutlet
{
    /**
     * Boot the scoped user outlet.
     */
    protected static function bootScopedByOutlet(): void
    {
        // Add global scope for query
        static::addGlobalScope(new OutletScope);

        // Auto fill outlet id on create new model
        static::creating(function (Model $model) {
            if (auth()->check()) {
                $outletId = auth()->user()->outlet_id;

                if (auth()->user()->can_access_multiple_outlets) {
                    $outletId = request()->header('Outlet-Id');
                }

                $model->outlet_id = $outletId;
            }
        });
    }

    /**
     * Disable the outlet scope.
     */
    public static function withoutOutletScope(): mixed
    {
        return (new static)->newQueryWithoutScope(new OutletScope);
    }
}
