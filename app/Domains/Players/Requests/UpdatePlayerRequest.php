<?php

namespace App\Domains\Players\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domains\Players\Models\Player;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $player = Player::query()
            ->select('id', 'user_id')
            ->findOrFail($this->route('player'));
        return [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:admins,email,' . $player->user_id,
            'password'    => 'nullable|string|min:8',
            'phone'       => 'required|string',
            'national_id' => 'required|string|unique:players,national_id,' . $player->id,
            'school'      => 'nullable|string',
            'weight'      => 'nullable|numeric',
            'height'      => 'nullable|numeric',
            'blood_type'  => 'nullable|string',
            'gender'      => 'required|in:male,female',
            'age'         => 'required|integer',
            'address'     => 'nullable|string',
            'location'    => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }
}
