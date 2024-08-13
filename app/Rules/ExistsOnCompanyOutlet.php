<?php

namespace App\Rules;

use App\Models\Outlet;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class ExistsOnCompanyOutlet implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string|null  $attribute
     * @return void
     */
    public function __construct(protected Model $model, protected string|null $attribute = null) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (auth()->check()) {
            $user = request()->user();

            $outletId = $user->can_access_multiple_outlets
                ? request()->header('Outlet-Id')
                : $user->outlet_id;

            if (!$outletId) {
                $fail('The outlet must be selected.');
            }

            $canAccessOutlet = Outlet::where('company_id', $user->company_id)
                ->where('id', $outletId)
                ->exists();

            if (!$canAccessOutlet) {
                $fail('The outlet not found.');
            }

            $dataExists = $this->model
                ->where('company_id', $user->company_id)
                ->where('outlet_id', $outletId)
                ->where($this->attribute ? $this->attribute : $attribute, $value)
                ->exists();

            if (!$dataExists) {
                $fail('The :attribute not found.');
            }
        }
    }
}
