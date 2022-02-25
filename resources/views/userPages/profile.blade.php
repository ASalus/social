
@extends('layouts.user.user')

@section('background-image', asset($data->userInfo->background))
@section('content')

<main class="profile-page">
    <section class="relative block" style="height: 500px;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style="background-image: url(@yield('background-image'));">
            <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span></div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;"><svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg></div>
    </section>
    <section class="profile-lower-section">
        <div class="container mx-auto px-4">
            <div class="tw-profile-container">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                    @include('userPages.profile-layouts.upperPart')
                    </div>

                    @include('userPages.profile-layouts.aboutSection')
                    <div class="tw-profile-posts-container">

                        @if(auth()->user()->id == $data->id)
                            @livewire('new-post', ['data'=> $data ])
                        @endif

                        @livewire('user-posts', ['data'=> $data])
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
