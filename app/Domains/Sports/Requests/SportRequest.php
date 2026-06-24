<?php

namespace App\Domains\Sports\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'status' => 'required|in:active,inactive',   
        ];
    }
}