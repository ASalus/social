<div class="z-50">
    <div class="mr-96 min-h-screen grid card rounded-box place-items-center bg-transparent">
        <div class="flex flex-wrap justify-center">
            @if ($post->image)
                <div id="postS{{ $post->id }}" class="carousel slide relative" data-bs-ride="carousel">
                    <div class="carousel-inner w-full overflow-hidden static">
                        <?php $i = 0; ?>
                        @foreach (json_decode($post->image) as $image)
                            @if ($i == 0)
                                <div class="carousel-item active relative float-left">
                                    <img class="inline-block max-h-screen max-w-full"
                                        src="{{ asset('storage/' . $image) }}">
                                </div>
                            @else
                                <div class="carousel-item relative float-left w-full">
                                    <img class="max-w-full max-h-screen inline-block"
                                        src="{{ asset('storage/' . $image) }}">
                                </div>
                            @endif
                            <?php $i += 1; ?>
                        @endforeach
                    </div>
                </div>
            @endif
            <div>
                <div class="flex flex-col">
                    <button x-data @click="$wire.emit('closeModal')" class="fixed left-0 top-0 rounded-full m-3">
                        <svg class="h-9 w-9 text-gray-300 rounded-full hover:bg-black hover:text-white" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                    @if (count((array) json_decode($post->image)) > 1)
                        <button
                            class="carousel-control-prev rounded-full my-96 absolute flex items-center justify-start ml-3 text-center p-2 border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline"
                            type="button" data-bs-target="#postS{{ $post->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon rounded-full  inline-block hover:bg-black"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                    @endif
                </div>
                <div class="flex flex-col">
                    @if (count((array) json_decode($post->image)) > 1)
                        <button
                            class="carousel-control-next rounded-full my-96 absolute flex items-center justify-end mr-3 cp-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline"
                            type="button" data-bs-target="#postS{{ $post->id }}" data-bs-slide="next">
                            <span
                                class="carousel-control-next-icon rounded-full inline-block bg-no-repeat hover:bg-black"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <aside
        class="fixed flex flex-col top-0 right-0 w-96 h-full shadow-md bg-white overflow-x-auto overflow-auto">
        <div x-data class="user-posts border rounded-xl">
            <div x-on:click.stop="" class="flex flex-shrink-0 p-4 pb-0">
                <object type="ouo">
                    <a href="/" class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block h-10 w-10 rounded-full"
                                    src="{{ asset('storage/' . $post->user->userInfo->avatar) }}" alt="">
                            </div>
                            <div class="ml-3">
                                <p
                                    class="text-base leading-6 font-bold text-blueGray-900 group-hover:text-blueGray-700">
                                    @yield('user-name')
                                    <span class="tw-post-auth-ad">
                                        {{ '@' . $post->user->username . ' · ' . date_format($post->created_at, 'd F Y') }}
                                    </span>

                                </p>
                            </div>
                        </div>
                    </a>
                </object>
            </div>
            <div class="pl-16">
                <p class="ml-3 w-auto tw-post-text break-words">
                    {!! $post->full_text !!}
                </p>

                <div class="flex">
                    <div class="flex w-full justify-center">
                        {{-- Repost --}}
                        <div class="flex-1 text-center py-2 m-2">
                            <div x-data="{ hover: false }" class="flex items-center hover:text-green-500">
                                <div x-on:click.stop="$wire.resendClick({{ $post->id }})"
                                    class="tw-post-links text-gray-500 hover:bg-green-500 hover:text-green-500 hover:bg-opacity-50"
                                    @mouseover="hover = true" @mouseout="hover = false"
                                    @if (auth()->user()->userPostStat->where('post_id', $post->id)->isNotEmpty()) :class="{
                                                                        'text-green-500': @js(auth()->user()->userPostStat->where('post_id', $post->id)->firstOrFail()->resend == true)
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
                                                                        'text-pink-600': @js(auth()->user()->userPostStat->where('post_id', $post->id)->firstOrFail()->liked == true)
                                                                    }" @endif>
                                    <a class="hover:text-pink-600">
                                        <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                            viewBox="0 0 24 24" user-darkreader-inline-stroke=""
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
                    </div>
                </div>
            </div>

        </div>
        <div class="">
            @livewire('user-profile.comments', ['post'=> $post->id])
        </div>
    </aside>
</div>
