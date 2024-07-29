<?php

namespace App\Traits;

use App\Models\Scopes\OutletScope;

trait ScopedByOutlet
{
    /**
     * Boot the scoped user outlet.
     */
    protected static function bootScopedByOutlet(): void
    {
        static::addGlobalScope(new OutletScope);
    }

    /**
     * Disable the outlet scope.
     */
    public static function withoutOutletScope()
    {
        return (new static)->newQueryWithoutScope(new OutletScope);
    }
}
