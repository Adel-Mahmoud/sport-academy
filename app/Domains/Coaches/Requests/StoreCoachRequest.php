<?php

namespace App\Domains\Coaches\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'has_account' => 'nullable|boolean',
            'name'           => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',

            'email'          => 'required_if:has_account,1,true|nullable|email|unique:users,email',
            'password'       => 'required_if:has_account,1,true|nullable|string|min:8',

            'hire_date'      => 'required|date',
            'salary'         => 'required|numeric|min:0',
            'is_active'      => 'nullable|boolean',
        ];
    }
}
