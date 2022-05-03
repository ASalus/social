<div>
    <x-moda formAction="save">
        <x-slot name="title">
            <h1 class="text-xl">Tell about yourself</h1>
        </x-slot>

        <x-slot name="content">
            <div class="container space-y-3">
                <label for="Location" class="flex mb-2 text-sm font-medium text-gray-900">
                    <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                    </svg>
                    Location
                </label>

                <div class="w-full">
                    <div x-data="select({ data: @entangle('countries'), emptyOptionsMessage: 'No countries match your search.', name: 'country', placeholder: 'Select a country' })" x-init="init()" @click.away="closeListbox()"
                        @keydown.escape="closeListbox()" class="relative">
                        <span class="inline-block w-full rounded-md shadow-sm">
                            <button type="button" x-ref="button" @click="toggleListboxVisibility()" :aria-expanded="open"
                                aria-haspopup="listbox"
                                class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                                    :class="{ 'text-gray-500': ! (value in options) }" class="block truncate"></span>

                                <input x-ref="search" x-show="open" x-model="search" @keydown.enter.stop.prevent="
                                    selectOption();
                                    " @keydown.arrow-up.prevent="focusPreviousOption();"
                                    @keydown.arrow-down.prevent="focusNextOption() ;" type="search"
                                    class="w-full h-full form-control focus:outline-none" />

                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </span>

                        <div x-show="open" x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                            class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                            <ul x-ref="listbox" @keydown.enter.stop.prevent="selectOption()
                                $wire.selectCountry(Object.values(options)[focusedOptionIndex])"
                                @keydown.arrow-up.prevent="focusPreviousOption()"
                                @keydown.arrow-down.prevent="focusNextOption()" role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                tabindex="-1"
                                class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                <template x-for="(key, index) in Object.keys(options)" :key="index">
                                    <li :id="name + 'Option' + focusedOptionIndex" @click="
                                        selectOption();
                                        " @mouseenter="focusedOptionIndex = index;"
                                        @mouseleave="focusedOptionIndex = null" role="option" :aria-selected="focusedOptionIndex === index"
                                        :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                        class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                        <span x-text="Object.values(options)[index]" :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                            class="block font-normal truncate"></span>

                                        <span x-show="key === value" :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </li>
                                </template>

                                <div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
                                    class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                            </ul>
                        </div>
                    </div>

                    @if ($country)
                        <div>
                            <div x-data="select({ data: @entangle('states'), emptyOptionsMessage: 'No states match your search.', name: 'state', placeholder: 'Select a state' })" x-init="init()" @click.away="closeListbox()"
                                @keydown.escape="closeListbox()" class="relative">
                                <span class="inline-block w-full rounded-md shadow-sm">
                                    <button type="button" x-ref="button" @click="toggleListboxVisibility()"
                                        :aria-expanded="open" aria-haspopup="listbox"
                                        class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                        <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                                            :class="{ 'text-gray-500': ! (value in options) }" class="block truncate"></span>

                                        <input x-ref="search" x-show="open" x-model="search"
                                            @keydown.enter.stop.prevent="
                                            selectOption();
                                        " @keydown.arrow-up.prevent="focusPreviousOption()"
                                            @keydown.arrow-down.prevent="focusNextOption()" type="search"
                                            class="w-full h-full form-control focus:outline-none" />

                                        <span
                                            class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                                stroke="currentColor">
                                                <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </span>

                                <div x-show="open" x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                                    class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                                    <ul x-ref="listbox" @keydown.enter.stop.prevent="
                                    selectOption();
                                    " @keydown.arrow-up.prevent="
                                    focusPreviousOption()" @keydown.arrow-down.prevent="
                                    focusNextOption()" role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" tabindex="-1"
                                        class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                        <template x-for="(key, index) in Object.keys(options)" :key="index">
                                            <li :id="name + 'Option' + focusedOptionIndex" @click="
                                                selectOption();
                                            " @mouseenter="focusedOptionIndex = index"
                                                @mouseleave="focusedOptionIndex = null" role="option" :aria-selected="focusedOptionIndex === index"
                                                :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                                class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                                <span x-text="Object.values(options)[index]" :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                    class="block font-normal truncate"></span>

                                                <span x-show="key === value" :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </li>
                                        </template>

                                        <div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
                                            class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                                    </ul>
                                </div>
                            </div>
                    @endif
                    @if ($state)
                        <div x-data="select({ data: @entangle('cities'), emptyOptionsMessage: 'No cities match your search.', name: 'city', placeholder: 'Select a city' })" x-init="init()" @click.away="closeListbox()"
                            @keydown.escape="closeListbox()" class="relative">
                            <span class="inline-block w-full rounded-md shadow-sm">
                                <button type="button" x-ref="button" @click="toggleListboxVisibility()"
                                    :aria-expanded="open" aria-haspopup="listbox"
                                    class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                                        :class="{ 'text-gray-500': ! (value in options) }" class="block truncate"></span>

                                    <input x-ref="search" x-show="open" x-model="search" @keydown.enter.stop.prevent="
                                        selectOption();
                                    " @keydown.arrow-up.prevent="focusPreviousOption()"
                                        @keydown.arrow-down.prevent="focusNextOption()" type="search"
                                        class="w-full h-full form-control focus:outline-none" />

                                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                            stroke="currentColor">
                                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </button>
                            </span>

                            <div x-show="open" x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                                class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                                <ul x-ref="listbox" @keydown.enter.stop.prevent="
                                selectOption();
                                " @keydown.arrow-up.prevent="
                                focusPreviousOption()" @keydown.arrow-down.prevent="
                                focusNextOption()" role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" tabindex="-1"
                                    class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                    <template x-for="(key, index) in Object.keys(options)" :key="index">
                                        <li :id="name + 'Option' + focusedOptionIndex" @click="
                                            selectOption();
                                        " @mouseenter="focusedOptionIndex = index"
                                            @mouseleave="focusedOptionIndex = null" role="option" :aria-selected="focusedOptionIndex === index"
                                            :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                            class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                            <span x-text="Object.values(options)[index]" :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                class="block font-normal truncate"></span>

                                            <span x-show="key === value" :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </li>
                                    </template>

                                    <div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
                                        class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if ($city)
                        <div class="flex justify-center" x-data="{ location: 0 }">
                            <div class="mb-3 xl:w-96">
                                <select wire:model="location"
                                    class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option selected value="Select location output type"> Select location output type
                                    </option>
                                    <optgroup label="Country, State">
                                        <option value="{{ $state['name'] . ', ' . $country['name'] }}">
                                            {{ $state['name'] . ', ' . $country['name'] }}</option>
                                        <option value="{{ $state['name'] . ', ' . $country['iso2'] }}">
                                            {{ $state['name'] . ', ' . $country['iso2'] }}</option>
                                        <option value="{{ $state['iso2'] . ', ' . $country['name'] }}">
                                            {{ $state['iso2'] . ', ' . $country['name'] }}</option>
                                        <option value="{{ $state['iso2'] . ', ' . $country['iso2'] }}">
                                            {{ $state['iso2'] . ', ' . $country['iso2'] }}</option>
                                    </optgroup>
                                    <optgroup label="City, Country">
                                        <option value="{{ $city['name'] . ', ' . $country['name'] }}">
                                            {{ $city['name'] . ', ' . $country['name'] }}</option>
                                        <option value="{{ $city['name'] . ', ' . $country['iso2'] }}">
                                            {{ $city['name'] . ', ' . $country['iso2'] }}</option>
                                    </optgroup>
                                    <optgroup label="City, State, Country">
                                        <option
                                            value="{{ $city['name'] . ', ' . $state['name'] . ', ' . $country['name'] }}">
                                            {{ $city['name'] . ', ' . $state['name'] . ', ' . $country['name'] }}
                                        </option>
                                        <option
                                            value="{{ $city['name'] . ', ' . $state['name'] . ', ' . $country['iso2'] }}">
                                            {{ $city['name'] . ', ' . $state['name'] . ', ' . $country['iso2'] }}
                                        </option>
                                        <option
                                            value="{{ $city['name'] . ', ' . $state['iso2'] . ', ' . $country['name'] }}">
                                            {{ $city['name'] . ', ' . $state['iso2'] . ', ' . $country['name'] }}
                                        </option>
                                        <option
                                            value="{{ $city['name'] . ', ' . $state['iso2'] . ', ' . $country['iso2'] }}">
                                            {{ $city['name'] . ', ' . $state['iso2'] . ', ' . $country['iso2'] }}
                                        </option>
                                    </optgroup>
                                    <optgroup label="City, State">
                                        <option value="{{ $city['name'] . ', ' . $state['name'] }}">
                                            {{ $city['name'] . ', ' . $state['name'] }}</option>
                                        <option value="{{ $city['name'] . ', ' . $state['iso2'] }}">
                                            {{ $city['name'] . ', ' . $state['iso2'] }}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900">Occupation</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M320 336c0 8.844-7.156 16-16 16h-96C199.2 352 192 344.8 192 336V288H0v144C0 457.6 22.41 480 48 480h416c25.59 0 48-22.41 48-48V288h-192V336zM464 96H384V48C384 22.41 361.6 0 336 0h-160C150.4 0 128 22.41 128 48V96H48C22.41 96 0 118.4 0 144V256h512V144C512 118.4 489.6 96 464 96zM336 96h-160V48h160V96z" />
                        </svg>
                    </div>
                    <input type="text" id="occupation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="" wire:model="occupation">
                </div>

                <label for="education" class="block mb-2 text-sm font-medium text-gray-900">Education</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M243.4 2.587C251.4-.8625 260.6-.8625 268.6 2.587L492.6 98.59C506.6 104.6 514.4 119.6 511.3 134.4C508.3 149.3 495.2 159.1 479.1 160V168C479.1 181.3 469.3 192 455.1 192H55.1C42.74 192 31.1 181.3 31.1 168V160C16.81 159.1 3.708 149.3 .6528 134.4C-2.402 119.6 5.429 104.6 19.39 98.59L243.4 2.587zM256 128C273.7 128 288 113.7 288 96C288 78.33 273.7 64 256 64C238.3 64 224 78.33 224 96C224 113.7 238.3 128 256 128zM127.1 416H167.1V224H231.1V416H280V224H344V416H384V224H448V420.3C448.6 420.6 449.2 420.1 449.8 421.4L497.8 453.4C509.5 461.2 514.7 475.8 510.6 489.3C506.5 502.8 494.1 512 480 512H31.1C17.9 512 5.458 502.8 1.372 489.3C-2.715 475.8 2.515 461.2 14.25 453.4L62.25 421.4C62.82 420.1 63.41 420.6 63.1 420.3V224H127.1V416z" />
                        </svg>
                    </div>
                    <input type="text" id="education"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="" value="" wire:model="education">
                </div>

                <label for="about" class="block mb-2 text-sm font-medium text-gray-900">About Me</label>
                <div class="relative">
                    <div class="flex absolute left-0 top-1 items-center pl-3 pointer-events-none">
                        <svg class="tw-profile-info-image w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S224 177.7 224 160C224 142.3 238.3 128 256 128zM296 384h-80C202.8 384 192 373.3 192 360s10.75-24 24-24h16v-64H224c-13.25 0-24-10.75-24-24S210.8 224 224 224h32c13.25 0 24 10.75 24 24v88h16c13.25 0 24 10.75 24 24S309.3 384 296 384z" />
                        </svg>
                    </div>
                    <textarea id="about" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        wire:model="about" placeholder="Tell about yourself" rows="5">
                </textarea>
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center p-3 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">Save</button>
            </div>
        </x-slot>
    </x-moda>
    <script>
        window.select = function(config) {
            return {
                data: config.data,

                emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',

                focusedOptionIndex: null,

                name: config.name,

                open: false,

                options: {},

                placeholder: config.placeholder ?? 'Select an option',

                search: '',

                value: config.value,

                closeListbox: function() {
                    this.open = false

                    this.focusedOptionIndex = null

                    this.search = ''
                },

                focusNextOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this
                        .options).length - 1

                    if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

                    this.focusedOptionIndex++

                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    })
                },

                focusPreviousOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

                    if (this.focusedOptionIndex <= 0) return

                    this.focusedOptionIndex--

                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    })
                },

                init: function() {
                    this.options = this.data

                    if (!(this.value in this.options)) this.value = null

                    this.$watch('search', ((value) => {
                        if (!this.open || !value) return this.options = this.data

                        this.options = Object.keys(this.data)
                            .filter((key) => this.data[key].toLowerCase().includes(value
                                .toLowerCase()))
                            .reduce((options, key) => {
                                options[key] = this.data[key]
                                return options
                            }, {})
                    }))
                },

                selectOption: function() {
                    if (!this.open) return this.toggleListboxVisibility()

                    this.value = Object.keys(this.options)[this.focusedOptionIndex]

                    switch (this.name) {
                        case 'country':
                            this.$wire.selectCountry(Object.keys(this.options)[this.focusedOptionIndex]);
                            break;
                        case 'state':
                            this.$wire.selectState(Object.keys(this.options)[this.focusedOptionIndex]);
                            break;
                        case "city":
                            this.$wire.selectCity(Object.keys(this.options)[this.focusedOptionIndex]);
                            break;
                        default:
                            console.log(this.name);
                    }
                    this.closeListbox()
                },

                toggleListboxVisibility: function() {
                    this.init()
                    if (this.open) return this.closeListbox()

                    this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                    if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                    this.open = true

                    this.$nextTick(() => {
                        this.$refs.search.focus()

                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "center"
                        })
                    })
                },
            }
        };
    </script>
</div>
