<div>
    <x-moda formAction="save">
        <x-slot name="title">
            <h1 class="text-xl">Tell about yourself</h1>
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <label for="Location" class="block mb-2 text-sm font-medium text-gray-900"><i
                        class="fas fa-map-marker-alt tw-profile-info-image"></i>Location</label>

                <div class="w-full">
                    <div x-data="select({ data: @entangle('countries'), emptyOptionsMessage: 'No countries match your search.', name: 'country', placeholder: 'Select a country' })" x-init="init()" @click.away="closeListbox()"
                        @keydown.escape="closeListbox()" class="relative">
                        <span class="inline-block w-full rounded-md shadow-sm">
                            <button type="button" x-ref="button" @click="toggleListboxVisibility()"
                                :aria-expanded="open" aria-haspopup="listbox"
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
                                @keydown.arrow-down.prevent="focusNextOption()" role="listbox"
                                :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                tabindex="-1"
                                class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                <template x-for="(key, index) in Object.keys(options)" :key="index">
                                    <li :id="name + 'Option' + focusedOptionIndex" @click="
                                        selectOption();
                                        " @mouseenter="focusedOptionIndex = index;"
                                        @mouseleave="focusedOptionIndex = null" role="option"
                                        :aria-selected="focusedOptionIndex === index"
                                        :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                        class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                        <span x-text="Object.values(options)[index]"
                                            :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                            class="block font-normal truncate"></span>

                                        <span x-show="key === value"
                                            :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
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
                                            :class="{ 'text-gray-500': ! (value in options) }"
                                            class="block truncate"></span>

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
                                    focusNextOption()" role="listbox"
                                        :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                        tabindex="-1"
                                        class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                        <template x-for="(key, index) in Object.keys(options)" :key="index">
                                            <li :id="name + 'Option' + focusedOptionIndex" @click="
                                                selectOption();
                                            " @mouseenter="focusedOptionIndex = index"
                                                @mouseleave="focusedOptionIndex = null" role="option"
                                                :aria-selected="focusedOptionIndex === index"
                                                :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                                class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                                <span x-text="Object.values(options)[index]"
                                                    :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                    class="block font-normal truncate"></span>

                                                <span x-show="key === value"
                                                    :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
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
                                        :class="{ 'text-gray-500': ! (value in options) }"
                                        class="block truncate"></span>

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
                                focusNextOption()" role="listbox"
                                    :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                    tabindex="-1"
                                    class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                                    <template x-for="(key, index) in Object.keys(options)" :key="index">
                                        <li :id="name + 'Option' + focusedOptionIndex" @click="
                                            selectOption();
                                        " @mouseenter="focusedOptionIndex = index"
                                            @mouseleave="focusedOptionIndex = null" role="option"
                                            :aria-selected="focusedOptionIndex === index"
                                            :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                            class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                                            <span x-text="Object.values(options)[index]"
                                                :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                class="block font-normal truncate"></span>

                                            <span x-show="key === value"
                                                :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
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
                        <i class="fas fa-briegfcase tw-profile-info-image"></i>
                    </div>
                    <input type="text" id="occupation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="" wire:model="occupation">
                </div>

                <label for="education" class="block mb-2 text-sm font-medium text-gray-900">Education</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <i class="fas fa-university tw-profile-info-image"></i>
                    </div>
                    <input type="text" id="education"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="" value="" wire:model="education">
                </div>

                <label for="about" class="block mb-2 text-sm font-medium text-gray-900">About Me</label>
                <div class="relative">
                    <div class="flex absolute left-0 top-1 items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-circle-info tw-profile-info-image"></i>
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
