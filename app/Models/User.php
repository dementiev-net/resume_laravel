<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    // таблица БД, ассоциированная с моделью
    protected $table = 'users_test';

    // The attributes that are mass assignable.
    protected $fillable = [
        'login', 'password', 'google_auth_code'
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', 'remember_token',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // шифрование пароля в базе
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
