<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required|min:3|max:20",
            "email"=>"required|unique:users",
            "password"=>"required|min:6|max:20",
            "role"=>"required" 
        ];
    }
    // customer error messages
    public function messages()
    {
      return [
          "name.required"=>"حقل الإسم فارغ",
          "name.min"=>"الإسم اقل من 3 احرف",
          "name.max"=>"الإسم طويل جدآ",
          "email.required"=>"الحقل فارغ",
          "email.unique"=>"الايميل موجود مسبقا",
          "password.min"=>"كلمة المرور اقل من 6 احرف",
          "password.max"=>"كلمة المرور اكبر من 20 حرف",
          "password.required"=>"الحقل فارغ",
          "role.required"=>"الحقل فارغ"
        ];
    }
}
