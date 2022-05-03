<div>
    @section('location')
        @if ($data->userInfo->location)
            <div class="tw-profile-user-loc flex justify-center items-center">
                <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                </svg>
                {{ $data->userInfo->location }}
            </div>
        @endif
    @endsection

    @section('occupation')
        @if ($data->userInfo->occupation)
            <div class="mb-2 text-blueGray-600 mt-10 flex justify-center items-center">
                <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M320 336c0 8.844-7.156 16-16 16h-96C199.2 352 192 344.8 192 336V288H0v144C0 457.6 22.41 480 48 480h416c25.59 0 48-22.41 48-48V288h-192V336zM464 96H384V48C384 22.41 361.6 0 336 0h-160C150.4 0 128 22.41 128 48V96H48C22.41 96 0 118.4 0 144V256h512V144C512 118.4 489.6 96 464 96zM336 96h-160V48h160V96z" />
                </svg>
                {{ $data->userInfo->occupation }}
            </div>
        @endif
    @endsection

    @section('education')
        @if ($data->userInfo->education)
            <div class="mb-2 text-blueGray-600 flex justify-center items-center">
                <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M243.4 2.587C251.4-.8625 260.6-.8625 268.6 2.587L492.6 98.59C506.6 104.6 514.4 119.6 511.3 134.4C508.3 149.3 495.2 159.1 479.1 160V168C479.1 181.3 469.3 192 455.1 192H55.1C42.74 192 31.1 181.3 31.1 168V160C16.81 159.1 3.708 149.3 .6528 134.4C-2.402 119.6 5.429 104.6 19.39 98.59L243.4 2.587zM256 128C273.7 128 288 113.7 288 96C288 78.33 273.7 64 256 64C238.3 64 224 78.33 224 96C224 113.7 238.3 128 256 128zM127.1 416H167.1V224H231.1V416H280V224H344V416H384V224H448V420.3C448.6 420.6 449.2 420.1 449.8 421.4L497.8 453.4C509.5 461.2 514.7 475.8 510.6 489.3C506.5 502.8 494.1 512 480 512H31.1C17.9 512 5.458 502.8 1.372 489.3C-2.715 475.8 2.515 461.2 14.25 453.4L62.25 421.4C62.82 420.1 63.41 420.6 63.1 420.3V224H127.1V416z" />
                </svg>
                {{ $data->userInfo->education }}
            </div>
        @endif
    @endsection

    @section('about')
        @if ($data->userInfo->about)
            <div class="tw-profile-about-container">
                <div class="flex flex-wrap justify-center" x-data="{ characters: 255 }">
                    <div class="w-full lg:w-9/12 px-4 tw-profile-about"
                        x-text="$truncate(@js($data->userInfo->about), characters)">
                    </div>
                    <div class="w-full lg:w-9/12 px-4">
                        <a class="font-normal text-blue-400 hover:cursor-pointer hover:text-blue-600 p-2"
                            @click=" characters === null ? characters=255 : characters=null "
                            x-text="characters === null ? 'Hide' : 'Show More'"></a>
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
</div>
