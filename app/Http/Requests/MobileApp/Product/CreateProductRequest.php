<?php

namespace App\Http\Requests\MobileApp\Product;

use App\Models\ProductType;
use App\Rules\ExistsOnCompanyOutlet;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_type_id' => ['required', new ExistsOnCompanyOutlet(new ProductType(), 'id')],
            'name' => 'required|max:255',
            'unit' => 'required',
            'price' => 'required|numeric|min:0',
            'fraction_quantity' => 'nullable|boolean',
            'minimum_quantity' => ['nullable', $this->fraction_quantity ? 'numeric' : 'integer', 'gt:0'],
            'duration_time' => 'nullable|sometimes|numeric|gt:0',
            'duration_type' => 'nullable',
            'wash' => 'nullable|boolean',
            'dry' => 'nullable|boolean',
            'iron' => 'nullable|boolean',
        ];
    }
}
