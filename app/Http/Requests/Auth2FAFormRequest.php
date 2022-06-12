<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Auth2FAFormRequest extends FormRequest
{
    public function authorize()
    {
        // для работы валидации
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|min:1|max:6',
        ];
    }

    // для собственных сообщениях об ошибках
    public function messages()
    {
        return [
            'code.required' => 'Введите код!',
            'code.min' => 'Код не может быть меньше 1-го символов!',
            'code.max' => 'Код не может быть больше 6-и символов!',
        ];
    }
}
