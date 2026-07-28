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
        $hasAccount = $this->boolean('has_account');

        return [
            'has_account' => 'nullable|boolean',
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',

            'email'       => $hasAccount
                ? 'required|email|unique:users,email,' . ($coach->user_id ?? 'NULL')
                : 'nullable|email',

            'password'    => 'nullable|string|min:8',
            'hire_date'   => 'required|date',
            'salary'      => 'required|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ];
    }
}
