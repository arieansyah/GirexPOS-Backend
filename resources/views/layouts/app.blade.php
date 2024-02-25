<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->

    @production
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        <script type="module" src="/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
        <link rel="stylesheet" href="/build/{{ $manifest['resources/sass/app.scss']['file'] }}">
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endproduction
    @routes
    @yield('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('layouts.navbar')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <main class="app-main">
            <!-- Content Header (Page header) -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">

                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            @yield('breadcrumb')
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="app-content">
                @yield('content')
            </div>
        </main>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
        @include('layouts.partials._notif')
    </div>
    <!-- ./wrapper -->

    @yield('scripts')
    @stack('scripts')
</body>

</html>
