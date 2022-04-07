@section('location')
    @if ($data->userInfo->location)
        <div class="tw-profile-user-loc">
            <i class="fas fa-map-marker-alt tw-profile-info-image"></i>
            {{ $data->userInfo->location }}
        </div>
    @endif
@endsection

@section('occupation')
    @if ($data->userInfo->occupation)
        <div class="mb-2 text-blueGray-600 mt-10">
            <i class="fas fa-briefcase tw-profile-info-image"></i>
            {{ $data->userInfo->occupation }}
        </div>
    @endif
@endsection

@section('education')
    @if ($data->userInfo->education)
        <div class="mb-2 text-blueGray-600">
            <i class="fas fa-university tw-profile-info-image"></i>
            {{ $data->userInfo->education }}
        </div>
    @endif
@endsection

@section('about')
    @if ($data->userInfo->about)
        <div class="tw-profile-about-container">
            <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-9/12 px-4">
                    <p class="tw-profile-about">{{ $data->userInfo->about }}</p>
                    <a href="#pablo" class="font-normal text-pink-500">Show more</a>
                </div>
            </div>
        </div>
    @endif
@endsection

<div class="text-center mt-12">
    <h3 class="tw-profile-user-name">{{ $data->name }}</h3>
    @yield('location')
    @yield('occupation')
    @yield('education')
</div>

@yield('about')
