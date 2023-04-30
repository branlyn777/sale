<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>VentaPlus</title>
        @include('layouts.landing.styles')
        @yield('landingcss')
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            @include('layouts.landing.navigation')
            
            @yield('content')

        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Dirección: Avenida Blanco Galindo Numero 45</div></div>
                    <div class="col-auto">
                        <a class="small" href="#!">Ver Mapa</a>
                        {{--<span class="mx-1">&middot;</span>
                         <a class="small" href="#!">Terms</a> --}}
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Contáctanos</a>
                    </div>
                </div>
            </div>
        </footer>
        @yield('landingjavascript')
        @include('layouts.landing.scripts')
    </body>
</html>
