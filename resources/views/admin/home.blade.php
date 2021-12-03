@extends('layouts.master')

@section('content')
    <div class="container">
        <script>
            window.auth = {!! $auth !!}
                window.routes = {!! $routes !!}
                window.trans = {!! $trans !!}
                window.token = "{!! $token !!}"
        </script>
        <link rel="stylesheet" href="/css/app.css" />

        <div id="app" class="pt-3">
            <app></app>
        </div>
        <script src="/js/app.js"></script>
    </div>
@endsection
