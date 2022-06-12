@extends('layouts.app')

@section('title')Главная страница@endsection

@section('main_content')

    <h3 class="header teal-text">Главная страница</h3>

    <p>Авторизация на сайте с помощью Google Authenticator</p>

    <p><a href="/register/" class="btn blue">Регистрация</a></p>
    <p>
        <a href="/login/" class="btn teal">Войти</a>
        <a href="/private/" class="btn red">Приватная страница</a>
    </p>

@endsection
