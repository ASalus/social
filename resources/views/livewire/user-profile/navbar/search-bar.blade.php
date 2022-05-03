<div id="search-container" class="tw-search-container z-0" x-data="{ open: false }">
    <div class="relative max-w-3xl mx-auto px-6" @click="open=true;" @click.away="open=false;">
        <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
            <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                </path>
            </svg>
        </div>
        <input id="search-toggle" type="search" placeholder="Enter search term ('/' to focus)"
            class="tw-search-input bg-brand-white" wire:model="search" autocomplete="off">

        <ul x-show="open" class="bg-white absolute flex flex-col rounded-md" style="width: 25rem">
            <div wire:loading class="justify-center">
                <x-loading-animation wire:loading></x-loading-animation>
            </div>
            @if ($users || $tags)
                @if (count($users) > 0)
                    <span class="text-base leading-6 font-bold text-black flex justify-center"> Users </span>
                    @foreach ($users as $user)
                        <li class="hover:bg-blue-400">
                            <a href="{{ route('user.profile', $user->username) }}">
                                <div class="flex flex-shrink-0">
                                    <div class="flex-1 ">
                                        <div class="flex items-center w-full">
                                            <div>
                                                <img class="inline-block h-10 w-10 rounded-full ml-4 mt-2"
                                                    src="{{ asset('storage/' . $user->userInfo->avatar) }}" alt="">
                                            </div>
                                            <div class="ml-3 mt-3">
                                                <p class="text-base leading-6 font-medium text-black">
                                                    {{ $user->name }}
                                                </p>
                                                <p
                                                    class="text-sm leading-5 font-medium text-gray-600 group-hover:text-gray-500 transition ease-in-out duration-150">
                                                    {{ '@' . $user->username }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
                @if (count($tags) > 0)
                    <span class="text-base font-bold leading-6 text-black flex justify-center"> Tags </span>
                    @foreach ($tags as $tag)
                        <li class="hover:bg-blue-400">
                            <a href="{{ route('search.tags', urlencode($tag->tag)) }}">
                                <div class="flex flex-shrink-0">
                                    <div class="flex-1 ">
                                        <div class="flex items-center w-full">
                                            <div>
                                                <svg class="inline-block h-10 w-auto rounded-full ml-4 mt-2"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="ml-3 mt-3">
                                                <p class="text-base leading-6 font-medium text-black">
                                                    {{ $tag->tag }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            @else
                <li>
                    <div class="ml-3 mt-3">
                        <p class="text-center text-base leading-6 font-medium text-black">
                            No results...
                        </p>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
