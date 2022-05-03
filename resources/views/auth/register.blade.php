@extends('layouts.app')

@section('link', route('login'))
@section('linkName', 'Sign In')
@section('orText', 'or create new account')

@section('content')
    <form method="POST" action="{{ route('register') }} " class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
        @csrf

        <div class="row mb-3 pt-4">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="Enter your name...">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="username" type="text"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
                    placeholder="Enter your username...">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Enter your email...">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Enter your password...">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Confirm your password...">
            </div>
        </div>

        <div class="px-4 pb-2 pt-4">
            <button type="submit"
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">sign
                up</button>
        </div>
    </form>
@endsection
