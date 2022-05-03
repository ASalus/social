<div>
    <div class="user-posts hover:cursor-pointer hover:bg-gray-100 border rounded-xl"
        wire:click.stop="openPostModal({{ $post->id }})">
        <div x-data x-on:click.stop="" class="relative flex flex-shrink-0 p-4 pb-0">
            @if ($post->userPostStat->where('resend', true)->where('user_id', $user->id)->isNotEmpty())
                <div class="absolute top-0  ml-5 flex items-center gap-x-2 text-gray-400">
                    <svg class="text-center h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" user-darkreader-inline-stroke=""
                        style="--darkreader-inline-stroke:currentColor;">
                        <path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4">
                        </path>
                    </svg>
                    <span>{{ $user->name }} reposted </span>
                </div>
            @endif
            <a href="{{ route('user.profile', $post->user->username) }}" class="flex-shrink-0 group block">
                <div class="flex items-center">
                    <div>
                        <img class="inline-block h-10 w-10 rounded-full"
                            src="{{ asset('storage/' . $post->user->userInfo->avatar) }}" alt="">
                    </div>
                    <div class="ml-3">
                        <p class="text-base leading-6 font-bold text-blueGray-900 group-hover:text-blueGray-700">
                            {{ $post->user->name }}
                            <span class="tw-post-auth-ad">
                                {{ '@' . $post->user->username . ' · ' . $this->dateFormat($post->created_at) }}
                            </span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="pl-16">
            <p class="ml-3 width-auto tw-post-text break-words">
                {!! $post->full_text !!}
            </p>
            <div class="flex flex-wrap justify-center">
                @if ($post->image)
                    <div id="post{{ $post->id }}" class="carousel slide carousel-fade relative"
                        data-bs-ride="carousel">
                        <div class="carousel-inner relative w-full overflow-hidden">
                            <?php $i = 0; ?>
                            @foreach (json_decode($post->image) as $image)
                                @if ($i == 0)
                                    <div class="carousel-item active relative float-left w-full">
                                        <img class="object-cover inline-block 'max-w-xl h-96"
                                            :class="{ 'max-w-[15rem] h-80': @json($post->to_post) }"
                                            src="{{ asset('storage/' . $image) }}">
                                    </div>
                                @else
                                    <div class="carousel-item relative float-left w-full">
                                        <img class="object-cover max-w-xl h-96 inline-block"
                                            :class="{ 'max-w-[15rem] h-80': @json($post->to_post) }"
                                            src="{{ asset('storage/' . $image) }}">
                                    </div>
                                @endif
                                <?php $i += 1; ?>
                            @endforeach
                        </div>
                        @if (count((array) json_decode($post->image)) > 1)
                            <button x-on:click.stop=""
                                class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                                type="button" data-bs-target="#post{{ $post->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon inline-block bg-no-repeat"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button x-on:click.stop=""
                                class="modPostImage carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                                type="button" data-bs-target="#post{{ $post->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon inline-block bg-no-repeat"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @endif

            </div>

            <div class="flex">
                <div class="w-full">
                    <div class="flex items-center">
                        {{-- Comment --}}
                        <div class="flex-1 text-center">
                            <div x-data="{ hover: false }" class="flex items-center">
                                <div class="tw-post-links text-gray-500 hover:bg-blue-600 hover:text-blue-600 hover:bg-opacity-50"
                                    @mouseover="hover = true" @mouseout="hover = false">
                                    <a x-on:click.stop="$wire.openPostModal({{ $post->id }});"
                                        class="hover:text-blue-600">
                                        <svg class="text-center h-6 w-6" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                            viewBox="0 0 24 24" user-darkreader-inline-stroke=""
                                            style="--darkreader-inline-stroke:currentColor;">
                                            <path
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                                <span class="text-gray-500 text-base font-medium"
                                    :class="{
                                        'text-blue-600': hover == true
                                    }">
                                    {{ $this->numberFilter($post->postsToPost->count()) }}
                                </span>
                            </div>
                        </div>
                        {{-- Repost --}}
                        <div class="flex-1 text-center py-2 m-2">
                            <div x-data="{ hover: false }" class="flex items-center hover:text-green-500">
                                <div x-on:click.stop="$wire.resendClick({{ $post->id }})"
                                    class="tw-post-links text-gray-500 hover:bg-green-500 hover:text-green-500 hover:bg-opacity-50"
                                    @mouseover="hover = true" @mouseout="hover = false"
                                    @if (auth()->user()->userPostStat->where('post_id', $post->id)->isNotEmpty()) :class="{
                                    'text-green-500': @js(auth()->user()->userPostStat->where('post_id',
                                    $post->id)->firstOrFail()->resend == true)
                                    }" @endif>
                                    <a class="hover:text-green-500">
                                        <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                            viewBox="0 0 24 24" user-darkreader-inline-stroke=""
                                            style="--darkreader-inline-stroke:currentColor;">
                                            <path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                                <span class="text-gray-500 text-base font-medium"
                                    :class="{
                                        'text-green-500': hover == true
                                    }">
                                    {{ $this->numberFilter($post->stats->resend) }}
                                </span>
                            </div>
                        </div>
                        {{-- Like --}}
                        <div class="flex-1 text-center py-2 m-2">
                            <div x-data="{ hover: false }" class="flex items-center ">
                                <div x-on:click.stop="$wire.likeClick({{ $post->id }})" @mouseover="hover = true"
                                    @mouseout="hover = false"
                                    class="tw-post-links text-gray-500 hover:bg-pink-600 hover:text-pink-600 hover:bg-opacity-50"
                                    @if (auth()->user()->userPostStat->where('post_id', $post->id)->isNotEmpty()) :class="{
                                    'text-pink-600': @js(auth()->user()->userPostStat->where('post_id',
                                    $post->id)->firstOrFail()->liked == true)
                                    }" @endif>
                                    <a class="hover:text-pink-600">
                                        <svg class="text-center h-7 w-6" fill='none'
                                            @if (auth()->user()->userPostStat->where('post_id', $post->id)->isNotEmpty()) :class="{
                                            'fill-current': @js(auth()->user()->userPostStat->where('post_id',
                                            $post->id)->firstOrFail()->liked == true)
                                            }" @endif
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            stroke="currentColor" viewBox="0 0 24 24" user-darkreader-inline-stroke=""
                                            style="--darkreader-inline-stroke:currentColor;">
                                            <path
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                                <span class="text-gray-500 text-base font-medium"
                                    :class="{
                                        'text-pink-600': hover == true
                                    }">
                                    {{ $this->numberFilter($post->stats->like) }}
                                </span>
                            </div>
                        </div>
                        @if (auth()->user()->id === $post->user_id)
                            <div class="flex-1 text-center">
                                <div x-data="{ hover: false }" class="flex items-center">
                                    <div class="tw-post-links text-gray-500 hover:bg-blue-600 hover:text-blue-600 hover:bg-opacity-50"
                                        @mouseover="hover = true" @mouseout="hover = false">
                                        <a x-on:click.stop="$wire.deleteConfirm({{ $post->id }});"
                                            class="hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                class="w-6 h-6 fill-current">
                                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
