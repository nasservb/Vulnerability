@extends('layouts.master')

@section('content')
    <link href="{{ asset('assets/css/login.css')}}" rel="stylesheet"/>
    <div class="page-single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 col-sm-9">
                    <div>
                        <div>
                            <div id="card" style="height: 270px">
                                <div class="front">
                                    <div class="card ">
                                        <div class="card-body  p-5 ">

                                            <div>{{__('auth.throttle')}}</div>
                                            <code>
                                                user: admin@admin.com<br>
                                                password: 12345678<br>
                                            </code>
                                            <div class="pull-right"><a id="togglePage"
                                                                       class="login-btn social-btn .btn i btn btn-blue btn-block text-center mt-2 "
                                                                       href="javascript:void(0)">Go to Login </a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="back" style="position: absolute">
                                    <div class="card ">
                                        <div class="card-body  px-5 py-2 ">
                                            <h3 class="text-center">{{ __('auth.Login with Email and Password') }}</h3>

                                            <!--/*form for login*/-->
                                            <form method="POST" action="{{route('login')}}">
                                                @csrf
                                                <div>
                                                    <!--/*username*/-->
                                                    <div class=" row">
                                                        <label for="name" class="col-12 col-form-label text-left">
                                                            {{ __('auth.E-Mail address') }}
                                                        </label>

                                                        <div class="col-md-12">
                                                            <input id="email" type="text"
                                                                   class="form-control @error('email') is-invalid @enderror"
                                                                   name="email" value="admin@admin.com" required
                                                                   autocomplete="email" autofocus>

                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!--/*password*/-->
                                                    <div class=" row">
                                                        <label for="email"
                                                               class="col-12 col-form-label text-left">{{ __('auth.Password') }}


                                                        </label>

                                                        <div class="col-md-12">
                                                            <input id="password" type="password"
                                                                   class="form-control @error('password') is-invalid @enderror"
                                                                   name="password" value="12345678" required>

                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!--/*login button*/-->
                                                    <input type="submit"
                                                           class="login-btn social-btn .btn i btn btn-green btn-block text-center m-2"
                                                           value=" {{ __('auth.Login') }}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center p-2 ">
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>


    <script>
        require(['jquery', 'flip'], function ($, flip) {
            $(document).ready(function () {

                $("#card").flip({axis: 'y', trigger: 'manual'});

                @if ($errors->any())
                $('#card').flip(true);
                $('.front').hide('fast');
                @else
                $('.back').hide('fast');
                @endif

                var pageShow = 1;

                $("#togglePage").click(function () {

                    if (pageShow == 0) {

                        $('.back').show('fast');
                        $('.front').show('fast');

                        $('#card').flip(false, function () {
                            $('.back').hide('fast');
                            $('.front').show('fast');
                        });

                        pageShow = 1;
                    } else {
                        $('.back').show('fast');
                        $('.front').show('fast');

                        window.dispatchEvent(new Event('resize'));

                        $('#card').flip(true, function () {
                            $('.front').hide('fast');
                            $('.back').show('fast');
                        });

                        pageShow = 0;
                    }
                });
            });
        });
    </script>

@endsection
