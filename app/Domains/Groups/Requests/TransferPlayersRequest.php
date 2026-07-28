<?php

namespace App\Domains\Groups\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferPlayersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_group_id'   => ['required', 'integer', 'exists:groups,id'],
            'target_group_id' => ['required', 'integer', 'exists:groups,id', 'different:from_group_id'],
            'player_ids'      => ['required', 'array', 'min:1'],
            'player_ids.*'    => ['required', 'integer', 'exists:players,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'player_ids.required'      => 'يرجى تحديد لاعب واحد على الأقل للنقل.',
            'target_group_id.required' => 'يرجى اختيار المجموعة المراد النقل إليها.',
            'target_group_id.different' => 'لا يمكنك نقل اللاعبين إلى نفس المجموعة الحالية.',
        ];
    }
}