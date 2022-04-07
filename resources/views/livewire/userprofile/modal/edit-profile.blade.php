<div>
    <x-moda formAction="save">
        <x-slot name="title">
            <h1>Change profile picture</h1>
        </x-slot>

        <x-slot name="content">
            <div class="">
                Photo Preview:
                @error('image') <span class="danger">{{ $message }}</span> @enderror
                @if ($image)
                    <img class="ml-auto mr-auto shadow-xl rounded-full h-60 border-none w-60 object-cover"
                        src="{{ $image->temporaryUrl() }}">
                @else
                    <img class="ml-auto mr-auto shadow-xl rounded-full h-60 border-none w-60 object-cover"
                        src="{{ asset('storage/' . $user->userInfo->avatar) }}" alt="">
                @endif

            </div>
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" wire:model="image"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                  " />
            </label>

            <div class="">
                Background Image Preview:
                @error('background') <span class="danger">{{ $message }}</span> @enderror
                @if ($background)
                    <img class="ml-auto mr-auto shadow-xl rounded-full h-60 border-none w-full object-cover"
                        src="{{ $background->temporaryUrl() }}">
                @else
                    <img class="ml-auto mr-auto rounded-full shadow-xl h-60 border-none w-full object-cover"
                        src="{{ asset('storage/' . $user->userInfo->background) }}" alt="">
                @endif
            </div>
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" wire:model="background"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                  " />
            </label>
        </x-slot>

        <x-slot name="buttons">
            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center p-3 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">Next</button>
            </div>
        </x-slot>
    </x-moda>
</div>
