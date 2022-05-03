@extends('layouts.app')

@section('link', route('login'))
@section('linkName', 'Sign Up')
@section('orText', 'or reset the password')

@section('content')

    <div class="flex justify-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="row mb-3 pt-4">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email"
                    class="form-control block w-full p-4 text-lg rounded-sm bg-black @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="px-4 pb-2 pt-4">
            <button type="submit"
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
                {{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
@endsection
