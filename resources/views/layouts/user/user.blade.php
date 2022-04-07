<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->username }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <script defer src="{{ asset('js/app.js') }}"></script>
    @livewireScripts


</head>

<body>
    <div>
        @include('layouts.user.navbar')
        @yield('content')
    </div>

</body>
@livewire('livewire-ui-modal')

</html>
