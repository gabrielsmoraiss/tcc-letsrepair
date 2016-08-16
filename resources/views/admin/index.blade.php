@extends('layouts.default')
@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>DashBoard</h1>
        <p>Por favor acesse um dos menus a cima.</p>
        <a href="{{ route('auth-google') }}">Ver Assistencias</a>
    </div>
@stop
