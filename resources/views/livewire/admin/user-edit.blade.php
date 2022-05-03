<div>
    <x-moda formAction="save">
        <x-slot name="title">
            <h1 class="text-xl">
                Edit {{ $user->name }}'s role
            </h1>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col justify-center">
                <div class="flex gap-x-2">
                    <div class="grow">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <div class="relative">
                            <select type="text" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                placeholder="Enter the email" autocomplete="off" wire:model="selectedRole">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" :selected="@js($role->id === $selectedRole)">
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
