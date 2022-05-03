@extends('layouts.app')

@section('link', route('login'))
@section('linkName', 'Back to sign in')

@section('content')
    <div class="card-header text-lg">{{ __('Reset Password') }}</div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>
        <div class="px-4 pb-2 pt-4">
            <button type="submit"
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
                {{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
