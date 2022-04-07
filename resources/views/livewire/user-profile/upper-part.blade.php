<div>
    @section('followers', $user->followers->count())
    @section('photos', $user->followed->count())
    @section('posts', $user->posts->count())
    @section('avatar', asset('storage/'.$user->userInfo->avatar))

    <div class="flex flex-wrap justify-center">
        <div class="lg:w-3/12 px-4 lg:order-2 flex justify-center">
            <div class="relative">
                <img alt="..." src="@yield('avatar')" class="shadow-xl rounded-full align-middle border-none  -m-16 -ml-20 lg:-ml-16 max-w-[200px] h-[200px] object-cover">
            </div>
        </div>
        <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
            {{-- {!! dd(auth()->user()->followed->where('user_id', $user->id)->count() == 1) !!} --}}
            @if(auth()->user()->id === $user->id)
                <div class="py-6 px-3 mt-32 sm:mt-0"><button class="tw-profile-header-button"  wire:click="$emit('openModal', 'userprofile.modal.edit-profile')"><i class="fa-solid fa-gear"></i> Profile Settings</button></div>
            @else

                @if(auth()->user()->followed->where('user_id', $user->id)->count())
                    <div class="py-6 px-3 mt-32 sm:mt-0"><button wire:click="unfollow({{ $user }})"
                            class="tw-profile-header-button">Unfollow</button></div>
                @else
                    <div class="py-6 px-3 mt-32 sm:mt-0"><button wire:click="follow({{ $user }})"
                            class="tw-profile-header-button">Follow</button></div>
                @endif
            @endif
        </div>
        <div class="w-full lg:w-4/12 px-4 lg:order-1">
            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center"><a href=""><span
                            class="tw-profile-stats-span">@yield('followers')</span><span
                            class="text-sm text-blueGray-400">Followers</span></a></div>
                <div class="mr-4 p-3 text-center"><a href=""><span
                            class="tw-profile-stats-span">@yield('photos')</span><span
                            class="text-sm text-blueGray-400">Followed</span></a></div>
                <div class="lg:mr-4 p-3 text-center"><span class="tw-profile-stats-span">@yield('posts')</span><span
                        class="text-sm text-blueGray-400">Posts</span></div>
            </div>
        </div>
    </div>
</div>

{{-- @push('scripts')

@endpush --}}