<div>

    <div class="new-user-post" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
        <form wire:submit.prevent='store'>
            @csrf
            <div class="flex">
                <div wire:ignore class="m-2 w-10 py-1">
                    <img class="inline-block h-10 w-10 rounded-full" src="{{ asset($avatar) }}" alt="">
                </div>
                <div class="flex-1 px-2 pt-2 mt-2" x-data>
                    <textarea class=" bg-transparent text-gray-400 font-medium text-lg w-full" rows="4" cols="50" placeholder="What's happening?" name='postText' wire:model='postText'></textarea>
                    {{-- @error('postText') <span class="error">{{ $message }}</span> @enderror --}}
                    <div class="flex flex-wrap justify-center">
                        @if ($images)
                        @foreach ($images as $image)
                        <img class="max-w-full h-52 inline-block w-52" src="{{ $image->temporaryUrl() }}">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-10"></div>

                <div class="w-64 px-2">

                    <div x-data class="flex items-center">
                        <div class="flex-1 text-center px-1 py-1 m-2">
                            <a wire:foo="updateImageInput" @click="$refs.fileInput.click()" class="tw-new-post-links">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:currentColor;">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </a>
                            <input x-ref='fileInput' type="file" wire:model="imageInput" hidden multiple>
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
                    <button wire:target='store' type="submit" {{ (isset($postText) && !empty($postText)) ? '' : 'disabled' }} class="tw-new-post-submit-btn">
                        New Post
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
