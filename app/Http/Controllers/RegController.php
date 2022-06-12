<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Services\GoogleService;

class RegController extends Controller
{
    protected $google;

    public function __construct(GoogleService $googleService)
    {
        $this->google = $googleService;
    }

    public function index()
    {
        return view('register');
    }

    public function create(RegisterFormRequest $request)
    {
        $secret = $this->google->createSecret();

        if (User::where('login', $request->input('login'))->exists()) {
            return redirect(route('register'))
                ->withErrors('Такой логин уже существует!');
        }

        User::create([
            'login' => $request->input('login'),
            'password' => $request->input('password'),
            'google_auth_code' => $secret,
        ]);

        $qrCodeUrl = $this->google->getQRCodeGoogleUrl($request->input('login'), $secret, 'LAR-TEST');

        return view('register', ['result' =>
            [
                'login' => $request->input('login'),
                'password' => $request->input('password'),
                'qrCodeUrl' => $qrCodeUrl
            ]]);
    }
}
