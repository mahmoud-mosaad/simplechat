<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Realtime Chat Application. Send text, images, voice. Voice Call, Video Call">
    <meta name="author" content="Mahmoud Mosaad">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <link href="{{ asset('static/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/app-dark.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Catamaran", sans-serif;
            line-height: 1.6;
            color: #333;
            font-size: 1.1rem;
        }

        h1,
        h2,
        h3,
        h4 {
            line-height: 1.3;
        }

        a {
            color: #444;
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            overflow: hidden;
            padding: 0 2rem;
        }

        .navbar {
            font-size: 1.2rem;
            padding-top: 0.3rem;
            padding-bottom: 0.3rem;
        }

        .navbar .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 2rem;
        }

        .navbar .logo {
            font-size: 2rem;
        }

        .navbar ul {
            justify-self: flex-end;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar a {
            padding: 0 1rem;
        }

        .navbar a:hover {
            color: #555;
        }

        /* .navbar {
            box-shadow: 0 .4px 8px #beb7b7;
            background-color:#fff;
        } */

        .container-fluid{
            padding: 0
        }

        .nav-guard{
            padding-top: 0.7rem;
            /* padding-bottom: 0.7rem; */
        }


    </style>
</head>
<body>

    <div class="container">
        <nav class="navbar nav-guard">
            <a class="navbar-brand" href="/">
            <h1 class="logo">SimpleChat</h1>
            </a>
            <ul class="nav">
    <!--          <li ><a href="/"><span>Home</span></a></li>-->
            <li ><a href="/register"><span>Get Started</span></a></li>
            <li ><a href="/login"><span>Login</span></a></li>
            <li ><a href="/#about"><span>About</span></a></li>
            <li ><a href="/#contact"><span>Contact</span></a></li>
            </ul>
        </nav>
    </div>

    @yield('content')

    <script src="{{ asset('static/js/jquery.min.js.download') }}"></script>
    <script src="{{ asset('static/js/bootstrap.bundle.min.js.download') }}"></script>
    <script src="{{ asset('static/js/simplebar.min.js.download') }}"></script>
    <script src="{{ asset('static/js/waves.min.js.download') }}"></script>
    <script src="{{ asset('static/js/app.js.download') }}"></script>
</body>
</html>
