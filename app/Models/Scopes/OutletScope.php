<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OutletScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $outletId = $model->outlet_id;
        $tableName = $model->getTable();

        if (auth()->check()) {
            $user = auth()->user();

            // If the user is admin, the user must select the outlet first
            if ($user->can_access_multiple_outlets) {
                $outletId = request()->header('Outlet-Id');
            } elseif ($user->employee) {
                // If the user is employee, the employee must be assigned to the outlet first
                $outletId = $user->employee->outlet_id;
            }
        }

        $builder->where($tableName . '.outlet_id', $outletId);
    }
}
