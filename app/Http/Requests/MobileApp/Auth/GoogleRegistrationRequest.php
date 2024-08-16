<?php

namespace App\Http\Requests\MobileApp\Auth;

use Illuminate\Foundation\Http\FormRequest;

class GoogleRegistrationRequest extends FormRequest
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
            'registration_token' => 'required',
            'company_name' => 'required|max:255',
            'outlet_name' => 'required|max:255',
            'outlet_address' => 'required',
            'outlet_phone' => 'required|max:100',
        ];
    }
}
