@section('friends', '21')
@section('photos', '21')
@section('posts', '21')
@section('avatar', asset($data->userInfo->avatar))


<div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
    <div class="relative"><img alt="..." src="@yield('avatar')" class="tw-profile-pic" style="max-width: 150px;"></div>
</div>
<div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
    <div class="py-6 px-3 mt-32 sm:mt-0"><button class="tw-profile-header-button" type="button">Fallow</button></div>
</div>
<div class="w-full lg:w-4/12 px-4 lg:order-1">
    <div class="flex justify-center py-4 lg:pt-4 pt-8">
        <div class="mr-4 p-3 text-center"><span class="tw-profile-stats-span">@yield('friends')</span><span class="text-sm text-blueGray-400">Friends</span></div>
        <div class="mr-4 p-3 text-center"><span class="tw-profile-stats-span">@yield('photos')</span><span class="text-sm text-blueGray-400">Photos</span></div>
        <div class="lg:mr-4 p-3 text-center"><span class="tw-profile-stats-span">@yield('posts')</span><span class="text-sm text-blueGray-400">Posts</span></div>
    </div>
</div>