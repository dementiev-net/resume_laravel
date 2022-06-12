@extends('layouts.app')

@section('title')Авторизация@endsection

@section('main_content')

    <h3 class="header teal-text">Авторизация</h3>

    @if($errors->any())
        <script>
            $(function () {
                @foreach($errors->all() as $error)
                M.toast({html: '{{ $error }}'});
                @endforeach
            }(jQuery));
        </script>
    @endif

    <form action="{{ route('user.login') }}" method="POST">
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
                <input type="submit" name="send" value="Войти" class="btn teal">
            </div>
        </div>

    </form>

@endsection
