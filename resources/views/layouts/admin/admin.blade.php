<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    @stack('styles')
    @livewireStyles
    @powerGridStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
    @livewireScripts
    @powerGridScripts
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.admin.navbar')

        @include('layouts.admin.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="row mb-2">
                    <div class="col-6">
                        <h1 class="table-header">@yield('title')</h1>
                    </div>
                    <div class="col-6">
                        @yield('action')
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.admin.controlAside')

        <!-- Main Footer -->
        @include('layouts.admin.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
</body>
@livewire('livewire-ui-modal')

</html>
