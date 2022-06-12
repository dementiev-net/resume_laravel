<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth2FAFormRequest;
use App\Http\Requests\AuthFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\GoogleService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $google;

    public function __construct(GoogleService $googleService)
    {
        $this->google = $googleService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect(route('private'));
        }
        return view('auth.login');
    }

    public function index_2fa()
    {
        if (Auth::check()) {
            return redirect(route('private'));
        }
        return view('auth.login_2fa');
    }

    public function check(AuthFormRequest $request)
    {
        $hash_password = hash('sha256', $request->input('password'));

        $user = User::where('login', $request->input('login'))
            ->where('password', $hash_password)
            ->first();

        if (!$user) {
            return redirect(route('user.login'))
                ->withErrors('Введен неверный логин или пароль!');
        }

        $request->session()->put('uid', $user->id);
        $request->session()->put('google_auth_code', $user->google_auth_code);

        return redirect(route('user.login_2fa'));
    }

    public function check_2fa(Auth2FAFormRequest $request)
    {
        $secret = $request->session()->get('google_auth_code');
        $uid = $request->session()->get('uid');

        // 2 = 2*30sec clock tolerance
        $checkResult = $this->google->verifyCode($secret, $request->input('code'), 2);

        if (!$checkResult) {
            return redirect(route('user.login_2fa'))
                ->withErrors('Код неверный!');
        }

        $user = User::find($uid);
        Auth::login($user);

        return redirect(route('private'));
    }

    public function out(Request $request)
    {
        $request->session()->put('uid', '');
        $request->session()->put('google_auth_code', '');
        if (empty($session_uid) && empty($request->session()->get('uid'))) {
            Auth::logout();
            return redirect('/');
        }
    }
}
