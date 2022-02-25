
{{-- @php
    $disabled = $errors->any() || empty($this->postText) ? true : false
@endphp --}}

<div class="new-user-post">
    <form wire:submit.prevent='store'>
        <div class="flex">
            <div class="m-2 w-10 py-1">
                <img class="inline-block h-10 w-10 rounded-full" src="{{ asset($data['info']->avatar) }}" alt="">
            </div>
            @csrf
            <input type="hidden" name='user_id' wire:model='user_id' value="{{ $data['user']->id }}">
            <div class="flex-1 px-2 pt-2 mt-2">
                <textarea class=" bg-transparent text-gray-400 font-medium text-lg w-full" rows="2" cols="50" placeholder="What's sss happening?" name='postText' wire:model.debounce.500ms='postText'></textarea>
            </div>
            @error('postText')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex">
            <div class="w-10"></div>

            <div class="w-64 px-2">

                <div class="flex items-center">
                    <div class="flex-1 text-center px-1 py-1 m-2">
                        <a href="#" class="tw-new-post-links">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:currentColor;">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a href="#" class="tw-new-post-links">
                            <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:currentColor;">
                                <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a href="#" class="tw-new-post-links">
                            <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:currentColor;">
                                <path d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a href="#" class="tw-new-post-links">
                            <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:currentColor;">
                                <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <button type="submit" class="bg-blue-400 mt-5 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full mr-8 float-right">
                    New Post
                </button>
            </div>
        </div>
    </form>
</div>