<div>
    <div x-data>
        <x-moda formAction="">
            <x-slot name="title">
                <h1 class="text-xl">
                    @if ($trigger == 'followers')
                        Users That Follow {{ $user->name }}
                    @else
                        Users Followed by {{ $user->name }}
                    @endif
                </h1>
            </x-slot>

            <x-slot name="content">

                {{-- Followed Section --}}
                @if ($trigger == 'followers' && $user->followers)
                    @foreach ($user->followers as $follower)
                        <a href="{{ route('user.profile', $follower->userFollower->username) }}">
                            <div
                                class="card border w-full hover:shadow-none relative flex flex-col mb-0 mx-auto shadow-lg">
                                <img class="max-h-20 w-full opacity-80 absolute top-0 z-0 object-cover"
                                    src="{{ asset('storage/' . $follower->userFollower->userInfo->background) }}"
                                    alt="" />
                                <div class="profile w-full flex m-3 ml-4 text-white z-10">
                                    <img class="w-28 h-28 p-1 bg-white rounded-full object-cover"
                                        src="{{ asset('storage/' . $follower->userFollower->userInfo->avatar) }}"
                                        alt="" />
                                    <div class="title mt-11 ml-3 font-bold flex flex-col">
                                        <div class="name break-words  text-gray-800">
                                            {{ $follower->userFollower->name }}
                                        </div>
                                        <!--  add [dark] class for bright background -->
                                        <div class="add font-semibold text-sm italic dark text-gray-600">
                                            {{ '@' . $follower->userFollower->username }}</div>
                                    </div>
                                    @if (auth()->user()->followed->where('user_id', $follower->userFollower->id)->count())
                                        <button x-on:click.prevent="$wire.unfollow({{ $follower->userFollower->id }})"
                                            class="h-6 flex absolute justify-end bottom-0 font-bold right-0 text-sm text-gray-500 space-x-0 my-3.5 mr-3">
                                            <div x-on:click.prevent=""
                                                class="add border rounded-l-2xl rounded-r-sm border-gray-300 py-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                                                Unfollow</div>
                                        </button>
                                    @else
                                        <button x-on:click.prevent="$wire.unfollow({{ $follower->userFollower->id }})"
                                            class="h-6 flex absolute justify-end bottom-0 font-bold right-0 text-sm text-gray-500 space-x-0 my-3.5 mr-3">
                                            <div x-on:click.prevent=""
                                                class="add border rounded-l-2xl rounded-r-sm border-gray-300 py-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                                                Follow</div>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
                {{-- Followed Section --}}
                @if ($trigger == 'followed' && $user->followed)
                    @foreach ($user->followed as $followed)
                        <a href="{{ route('user.profile', $followed->user->username) }}">
                            <div
                                class="card border w-full hover:shadow-none relative flex flex-col mb-0 mx-auto shadow-lg">
                                <img class="max-h-20 w-full opacity-80 absolute top-0 z-0 object-cover"
                                    src="{{ asset('storage/' . $followed->user->userInfo->background) }}" alt="" />
                                <div class="profile w-full flex m-3 ml-4 text-white z-10">
                                    <img class="w-28 h-28 p-1 bg-white rounded-full object-cover"
                                        src="{{ asset('storage/' . $followed->user->userInfo->avatar) }}" alt="" />
                                    <div class="title mt-11 ml-3 font-bold flex flex-col">
                                        <div class="name break-words text-gray-800">{{ $followed->user->name }}</div>
                                        <!--  add [dark] class for bright background -->
                                        <div class="add font-semibold text-sm italic dark text-gray-600">
                                            {{ '@' . $followed->user->username }}</div>
                                    </div>
                                    @if (auth()->user()->followed->where('user_id', $followed->user->id)->count())
                                        <button x-on:click.prevent="$wire.unfollow({{ $followed->user->id }})"
                                            class="h-6 flex absolute justify-end bottom-0 font-bold right-0 text-sm text-gray-500 space-x-0 my-3.5 mr-3">
                                            <div x-on:click.prevent=""
                                                class="add border rounded-l-2xl rounded-r-sm border-gray-300 py-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                                                Unfollow</div>
                                        </button>
                                    @else
                                        <button x-on:click.prevent="$wire.unfollow({{ $followed->user->id }})"
                                            class="h-6 flex absolute justify-end bottom-0 font-bold right-0 text-sm text-gray-500 space-x-0 my-3.5 mr-3">
                                            <div x-on:click.prevent=""
                                                class="add border rounded-l-2xl rounded-r-sm border-gray-300 py-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                                                Follow</div>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </x-slot>

            <x-slot name="buttons">
                <div class="flex justify-end">
                    <button type="button"
                        class="flex items-center p-3 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">Close</button>
                </div>
            </x-slot>
        </x-moda>
    </div>
</div>
