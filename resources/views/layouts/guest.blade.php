<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])




    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('template/images/favicon.svg') }}" type="image/x-icon" />
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('template/fonts/tabler-icons.min.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('template/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('template/css/style-preset.css') }}" id="preset-style-link" />
    <!-- [My Styles Own] -->
    {{-- <link rel="stylesheet" href="{{ asset('own/styles.css') }}" id="preset-style-link" /> --}}
    <!-- [Bootstrap Icons] -->
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" id="preset-style-link" />
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <a href="#" class="d-flex justify-content-center">
                            <img width="200px" src="{{ asset('template/images/logo.png') }}" />
                        </a>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="auth-header">
                                    <h2 class="text-primary mt-5"><b>Sistema de Venta</b></h2>
                                </div>
                            </div>
                        </div>
                        <h5 class="my-4 d-flex justify-content-center">Iniciar Sesión</h5>



                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <x-text-input id="email" class="form-control" type="email" name="email" placeholder="Email address / Username" :value="old('email')" required autofocus autocomplete="username" />
                                <label for="floatingInput">Correo / Usuario</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required autocomplete="current-password" />
                                <label for="floatingInput">Contraseña</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="form-check-input input-primary mr-2" name="remember">
                                        <span class="form-check-label text-muted" for="customCheckc1">{{ __('Recordar Sesión') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </x-primary-button>
                            </div>
                        </form>





                        <hr />
                        <h5 class="d-flex justify-content-center">¿No tienes cuenta?</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{ asset('template/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/config.js') }}"></script>
    <script src="{{ asset('template/js/pcoded.js') }}"></script>

</body>

</html>
