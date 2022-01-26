<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <title>{{ config('backpack.base.project_name') ?? 'SimpleChat | Enjoy The Experience' }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="Mahmoud Mosaad" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}">

        <!-- magnific-popup css -->
        <link href="{{ asset('messenger2/magnific-popup.css') }}" rel="stylesheet" type="text/css">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{ asset('messenger2/owl.carousel.min.css') }}">

        <link rel="stylesheet" href="{{ asset('messenger2/owl.theme.default.min.css') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('messenger2/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">
        <!-- <link href="{{ asset('messenger2/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"> -->

        <!-- Icons Css -->
        <link href="{{ asset('messenger2/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('messenger2/app-rtl.min.css') }}" rel="stylesheet" type="text/css">
        <!-- <link href="{{ asset('messenger2/app-dark.min.css') }}" rel="stylesheet" type="text/css"> -->

        <link href="{{ asset('messenger2/all.min.css') }}" rel="stylesheet" type="text/css">

        <script>

            window._asset = '{{ asset('') }}';
            window._url = '{{ url('/') }}';
            window._backpack_url = '{{ url('/') }}';

        </script>

        <script src="{{ asset('messenger2/vue-record-audio.umd.js') }}"></script>
    </head>

    <body>
        <div id="app">
            <app></app>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('messenger2/jquery.min.js.download') }}"></script>
        <script src="{{ asset('messenger2/bootstrap.bundle.min.js.download') }}"></script>
        <script src="{{ asset('messenger2/simplebar.min.js.download') }}"></script>
        <script src="{{ asset('messenger2/waves.min.js.download') }}"></script>

        <!-- Magnific Popup-->
        <script src="{{ asset('messenger2/jquery.magnific-popup.min.js.download') }}"></script>

        <!-- owl.carousel js -->
        <script src="{{ asset('messenger2/owl.carousel.min.js.download') }}"></script>

        <script src="{{ asset('messenger2/app.js.download') }}"></script>

        <script src="{{ asset('js/chat-app.js') }}" defer></script>

        <!-- </div> -->
        <div class="hs-dummy-scrollbar-size">
            <div style="height: 200%; width: 200%; margin: 10px 0;">

            </div>
        </div>
    </body>
</html>
