<?php

namespace App\Domains\Players\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:8',
            'phone'       => 'required|string',
            'school'      => 'nullable|string',
            'weight'      => 'nullable|numeric',
            'height'      => 'nullable|numeric',
            'blood_type'  => 'nullable|string',
            'gender'      => 'required|in:male,female',
            'age'         => 'required|integer',
            'address'     => 'nullable|string',
            'location'    => 'nullable|string',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'national_id' => 'required|string|unique:players,national_id',
        ];
    }
}