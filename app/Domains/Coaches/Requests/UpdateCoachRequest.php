<?php

namespace App\Domains\Coaches\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domains\Coaches\Models\Coach;

class UpdateCoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $coach = Coach::query()
            ->select('id', 'user_id')
            ->findOrFail($this->route('coach'));
        return [
            'name'      => 'required|string|max:255',
            'phone'     => 'nullable|string|max:20',
            'email'     => 'required|email|unique:users,email,' . $coach->user_id,
            'password'    => 'nullable|string|min:8',
            'hire_date' => 'required|date',
            'salary'    => 'required|numeric|min:0',
        ];
    }
}