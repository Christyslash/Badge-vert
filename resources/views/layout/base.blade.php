<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico"/>

    <title>@yield('title') </title>
    {{--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">--}}
    <link rel="stylesheet" href="{{asset('assets/fonts/google-api.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/tabler.min.css')}}">

    <!-- Dashboard Core -->
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/fontawesome.css')}}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('assets/custorm/app.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/custorm/loader.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fonts/css/font-awesome.min.css')}}">

</head>
<body style="color: black">
<div id="loader">
    <div class="spinner"></div>
    <p class="chargement text-danger"><b> Chargement en cours...</b></p>
</div>
<a id="debut"></a>
<div class="page">
    <div class="page-main">

        @include("blocks.header")
        <div class="my-3 my-md-5">
            <div class="container">
                <div class="content-app">
                    <div class="mb-2 page-title-box  align-items-center justify-content-between">
                        @yield('title-header')
                    </div>
                    @yield('content-main')
                </div>
            </div>
        </div>
    </div>
    @include("blocks.footer")
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset("assets/js/tabler.min.js")}}"></script>
<script src="{{asset("assets/js/require.min.js")}}"></script>
<script src="{{asset("assets/js/dashboard.js")}}"></script>
<script src="{{asset("assets/js/vendors/jquery-3.2.1.min.js")}}"></script>
<script src="{{asset('assets/custorm/app.js?version=1.1')}}"></script>
<script src="{{asset('assets/custorm/loader.js')}}"></script>

<script>
    requirejs.config({
        baseUrl: 'http://127.0.0.1:8001/'
    });
</script>

</body>
</html>
