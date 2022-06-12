@extends('layouts.app')

@section('title')Авторизация@endsection

@section('main_content')

    <h3 class="header teal-text">Регистрация</h3>

    @if($errors->any())
        <script>
            $(function () {
                @foreach($errors->all() as $error)
                M.toast({html: '{{ $error }}'});
                @endforeach
            }(jQuery));
        </script>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row">
            <div class="input-field col s3">
                <input id="login" name="login" type="text">
                <label for="login">Логин:</label>
            </div>
            <div class="input-field col s3">
                <input id="password" name="password" type="password">
                <label for="password">Пароль:</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" name="send" value="Добавить" class="btn teal">
            </div>
        </div>

    </form>

    @if(isset($result))

        <h4>Результат:</h4>

        <p>
            Логин: <b>{{ $result['login'] ?? '' }}</b><br>
            Пароль: <b>{{ $result['password'] ?? '' }}</b>
        </p>

        <div class="row">
            <div class="input-field col s6">
                <p>1. Установите Google Authenticator на свой телефон:</p>

                <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"><img
                        src="/images/iphone.png"/></a>
                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                   target="_blank"><img src="/images/android.png"/></a>
            </div>
            <div class="input-field col s4">
                <p>2. добавьте в него код:</p>

                <p><img src='{{ $result['qrCodeUrl'] ?? '' }}'/></p>
            </div>
        </div>
    @endif

@endsection
