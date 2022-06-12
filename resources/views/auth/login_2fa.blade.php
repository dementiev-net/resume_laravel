@extends('layouts.app')

@section('title')Авторизация@endsection

@section('main_content')

    <h3 class="header teal-text">Подтверждение (2FA)</h3>

    @if($errors->any())
        <script>
            $(function () {
                @foreach($errors->all() as $error)
                M.toast({html: '{{ $error }}'});
                @endforeach
            }(jQuery));
        </script>
    @endif

    <p>Введите проверочный код, созданный приложением Google Authenticator на вашем телефоне.</p>

    <form action="{{ route('user.login_2fa') }}" method="POST">
        @csrf
        <div class="row">
            <div class="input-field col s3">
                <input id="code" name="code" type="text">
                <label for="code">Код:</label>
            </div>
            <div class="input-field col s6">
                <input type="submit" name="send" value="Отправить" class="btn teal">
            </div>
        </div>

    </form>

@endsection
