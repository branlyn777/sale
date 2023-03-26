<!DOCTYPE html>
<html lang="es">
<!-- [Head] start -->

<head>
    <title>Venta</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Berry is made using Bootstrap 5 design framework. Download the free admin template & use it for your project." />
    <meta name="keywords"
        content="Berry, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template" />
    <meta name="author" content="CodedThemes" />

    @include('layouts.theme.styles')
    @yield('css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Header Topbar ] start -->
    @include('layouts.theme.header')
    <!-- [ Header ] end -->
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.theme.sidebar')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.theme.footer')
    @yield('javascript')
    @include('layouts.theme.scripts')
</body>
<!-- [Body] end -->

</html>
