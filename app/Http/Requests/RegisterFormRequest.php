<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        // для работы валидации
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required|min:4|max:100',
            'password' => 'required|min:4|max:100',
        ];
    }

    // для собственных сообщениях об ошибках
    public function messages()
    {
        return [
            'login.required' => 'Введите логин!',
            'login.min' => 'Логин не может быть меньше 4-х символов!',
            'login.max' => 'Логин не может быть больше 100-а символов!',
            'password.required' => 'Введите пароль!',
            'password.min' => 'Пароль не может быть меньше 4-х символов',
            'password.max' => 'Пароль не может быть больше 100-а символов',
        ];
    }
}
