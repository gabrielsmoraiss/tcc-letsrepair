<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords' , '')">
    <meta name="author" content="Gabriel Silva de Morais">
    <meta name="ROBOTS" content="INDEX,FOLLOW">
    <title>Let's Repair | @yield('title', 'Lets Repair')</title>
    @include('layouts.css')
</head>


<body>
    {!! Html::flash() !!}
    {{--dd(!Request::is('index'))--}}
    @if($current_user)
        @include('layouts.navbar')
    @else
        @include('layouts.navbarApp')
    @endif

    @yield('content')

    @include('layouts.js')
</body>

</html>