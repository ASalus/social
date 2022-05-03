<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->username }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.css"
        integrity="sha512-GnwBnXd+ZGO9CdP343MUr0jCcJXCr++JVtQRnllexRW2IDq4Zvrh/McTQjooAKnSUbXZ7wamp7AQSweTnfMVoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    <div>
        @include('layouts.user.navbar')
        @yield('content')
    </div>


    @stack('scripts')
</body>
@livewire('livewire-ui-modal')

</html>
