<?php

namespace App\Domains\Groups\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPlayersToGroupRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'group_id'     => 'required|integer|exists:groups,id',
            'player_ids'   => 'required|array|min:1',
            'player_ids.*' => 'required|integer|exists:players,id',
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.required'   => 'يجب تحديد المجموعة.',
            'group_id.exists'     => 'المجموعة المحددة غير موجودة.',
            'player_ids.required' => 'يرجى اختيار لاعب واحد على الأقل.',
            'player_ids.array'    => 'صيغة قائمة اللاعبين غير صحيحة.',
            'player_ids.min'      => 'يجب اختيار لاعب واحد على الأقل للإضافة.',
            'player_ids.*.exists' => 'أحد اللاعبين المحددين غير موجود بنظام.',
        ];
    }
}