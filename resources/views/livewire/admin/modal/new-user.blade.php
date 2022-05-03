<div>
    <x-moda formAction="save">
        <x-slot name="title">
            <h1 class="text-xl">
                New User
            </h1>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col justify-center">
                <div class="flex gap-x-2">
                    <div class="grow">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <div class="relative">
                            <input type="text" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 form-control @error('name') is-invalid @enderror"
                                placeholder="Enter the name" name="name" autocomplete="name" wire:model="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grow">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <div class="relative">
                            <input type="text" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 form-control @error('username') is-invalid @enderror"
                                placeholder="Enter the username" autocomplete="username" name="username"
                                wire:model="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex gap-x-2">
                    <div class="grow">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <div class="relative">
                            <input type="text" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 form-control @error('email') is-invalid @enderror"
                                placeholder="Enter the email" autocomplete="email" name="email" wire:model="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex gap-x-2">
                    <div class="grow">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <div class="relative" x-data="{ show: true }">
                            <input :type="show ? 'password' : 'text'" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 form-control @error('password') is-invalid @enderror"
                                placeholder="Enter the password" autocomplete="off" wire:model="password">
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 @error('password') mr-3 top-0 @enderror">

                                <svg class="h-4 w-4 text-gray-700" fill="none" @click="show = !show"
                                    :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>

                                <svg class="h-4 w-4 text-gray-700" fill="none" @click="show = !show"
                                    :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>

                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grow">
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Password
                            confirmation</label>
                        <div class="relative" x-data="{ show: true }">
                            <input :type="show ? 'password' : 'text'" id="confirm-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 form-control @error('passwordConfirm') is-invalid @enderror"
                                placeholder="Confirm the password" autocomplete="off" wire:model="passwordConfirm">
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 @error('passwordConfirm') mr-3 top-0 @enderror">

                                <svg class="h-4 w-4 text-gray-700" fill="none" @click="show = !show"
                                    :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>

                                <svg class="h-4 w-4 text-gray-700" fill="none" @click="show = !show"
                                    :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>

                            </div>
                            @error('passwordConfirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex gap-x-2">
                    <div class="grow">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <div class="relative">
                            <select id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                placeholder="Enter the email" autocomplete="off" wire:model="selectedRole">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" :selected="@json($role->id === $selectedRole)">
                                        {{ $role->role_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center p-3 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">Submit</button>
            </div>
        </x-slot>
    </x-moda>
</div>
