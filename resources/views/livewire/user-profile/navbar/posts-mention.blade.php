<div>
    <a class="{{ $class }}" data-bs-toggle="dropdown" href="#" id="dropdownMenuLink">
        <svg class="lg:text-blueGray-200 w-6 h-6 lg:hover:text-blueGray-500"
            style="vertical-align: middle;fill: currentColor;overflow: hidden;" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 512">
            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
                d="M416 176C416 78.8 322.9 0 208 0S0 78.8 0 176c0 39.57 15.62 75.96 41.67 105.4c-16.39 32.76-39.23 57.32-39.59 57.68c-2.1 2.205-2.67 5.475-1.441 8.354C1.9 350.3 4.602 352 7.66 352c38.35 0 70.76-11.12 95.74-24.04C134.2 343.1 169.8 352 208 352C322.9 352 416 273.2 416 176zM599.6 443.7C624.8 413.9 640 376.6 640 336C640 238.8 554 160 448 160c-.3145 0-.6191 .041-.9336 .043C447.5 165.3 448 170.6 448 176c0 98.62-79.68 181.2-186.1 202.5C282.7 455.1 357.1 512 448 512c33.69 0 65.32-8.008 92.85-21.98C565.2 502 596.1 512 632.3 512c3.059 0 5.76-1.725 7.02-4.605c1.229-2.879 .6582-6.148-1.441-8.354C637.6 498.7 615.9 475.3 599.6 443.7z" />
        </svg>
        <span class="badge nav-badge">{{ $posts->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        @forelse ($posts->take($this->loadAmount) as $post)
            <div class="dropdown-item hover:cursor-pointer" wire:click.stop="openPostModal({{ $post->id }})">
                <div class="flex">
                    <div class="flex-1 ">
                        <div class="flex items-center w-full">
                            <div class="w-10">
                                <img class="inline-block h-10 w-10 rounded-full ml-4 mt-2"
                                    src="{{ asset('storage/' . $post->user->userInfo->avatar) }}" alt="">
                            </div>
                            <div class="ml-5 mt-3">
                                <p class="text-base leading-6 font-medium text-black">
                                    {{ $post->user->name }}
                                    <span class="tw-post-auth-ad">
                                        {{ ' · ' . $this->dateFormat($post->created_at) }}
                                    </span>
                                </p>
                                <p
                                    class="text-sm leading-5 font-medium text-gray-600 group-hover:text-gray-500 transition ease-in-out duration-150 break-words">
                                    {!! Illuminate\Support\Str::limit(strip_tags($post->full_text), 50) !!}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
        @endforelse
        <div class="dropdown-divider"></div>
        <a href="{{ route('search.tags', urlencode('@') . auth()->user()->username) }}"
            class="dropdown-item dropdown-footer">See
            All Messages</a>
    </div>
</div>
