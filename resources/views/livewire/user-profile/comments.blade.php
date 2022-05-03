<div class="relative">
    {{-- New Comment Form --}}
    <div class="new-user-post ml-4" x-data="data()">
        <form wire:submit.prevent='store'>
            @csrf
            <div x-show="!open" class="flex">
                <div class="m-2 w-10 py-1">
                    <img class="inline-block h-10 w-10 rounded-full"
                        src="{{ asset('storage/' . auth()->user()->userInfo->avatar) }}" alt="">
                </div>
                <div class="flex-1 px-2 pt-2 mt-2">
                    <textarea wire:ignore class="bg-transparent resize-none text-gray-400 font-medium text-lg w-full" rows="1"
                        @click="open=true; $nextTick(() => $refs.postArea.focus())"
                        placeholder="Comment the post?"></textarea>
                    {{-- @error('postText') <span class="error">{{ $message }}</span> @enderror --}}
                </div>
            </div>

            <div x-show="open" x-transition:enter="transition ease duration-300 transform"
                x-transition:enter-start="opacity-0 -translate-y-0" x-transition:enter-end="opacity-100 -translate-y-0"
                class="flex flex-col" @click.away="open=false;">
                <div class="flex">
                    <div class="m-2 w-10 py-1">
                        <img class="inline-block h-10 w-10 rounded-full"
                            src="{{ asset('storage/' . auth()->user()->userInfo->avatar) }}" alt="">
                    </div>
                    <div class="relative flex-1 px-2 pt-2 mt-2" x-data="{ content: @entangle('postText') }">
                        <div id='postCom{{ $post->id }}' maxlength='255'
                            class='postArea text-left bg-transparent text-gray-400 font-medium text-lg w-full overflow-y-auto h-28'
                            x-ref="postArea" placeholder="Comment the post?"
                            @input|keydown|click='content = $event.target.innerHTML;' name="postTest" wire:ignore></div>
                        <span contenteditable="false"
                            class="absolute px-2 py-1 text-xs text-blueGray-600 rounded right-2 bottom-0"
                            x-text="$refs.postArea.getAttribute('maxlength') - @js(strlen(strip_tags(str_replace('&nbsp;', ' ', $postText))))"
                            x-cloak></span>
                        @error('postText')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <ul wire:ignore id="galleryModal" class="flex flex-1 flex-wrap -m-1">
                            <li id="empty" class="h-full w-full text-center flex flex-col justify-center ">
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex">
                    <div class="w-10"></div>

                    <div class="w-64 px-2">
                        <div aria-label="File Upload Modal" class="flex items-center" ondrop="dropHandler(event);"
                            ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
                            ondragenter="dragEnterHandler(event);">
                            <div class="flex-1 text-center px-1 py-1 m-2">
                                <div class="">
                                    <input wire:ignore id="hiddenInput{{ $post->id }}"
                                        wire:model.debounce="imageInputModal" type="file" multiple
                                        class="hidden" />
                                    <a class="tw-new-post-links" id="buttonModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-center h-7 w-6" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            stroke="currentColor" viewBox="0 0 24 24" data-darkreader-inline-stroke=""
                                            style="--darkreader-inline-stroke:currentColor;">
                                            <path
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="tw-new-post-links">
                                    <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" data-darkreader-inline-stroke=""
                                        style="--darkreader-inline-stroke:currentColor;">
                                        <path
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                        </path>
                                        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="tw-new-post-links">
                                    <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" data-darkreader-inline-stroke=""
                                        style="--darkreader-inline-stroke:currentColor;">
                                        <path
                                            d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </a>
                            </div>

                            <div class="flex-1 text-center py-2 m-2">
                                <a href="#" class="tw-new-post-links">
                                    <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" data-darkreader-inline-stroke=""
                                        style="--darkreader-inline-stroke:currentColor;">
                                        <path
                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1">
                        <button wire:target='store' id="submitModal"
                            {{ isset($postText) && !empty($postText) ? '' : 'disabled' }}
                            class="tw-new-post-submit-btn"
                            @click="$wire.postText = $refs.postArea.innerHTML; $refs.postArea.innerHTML = ''">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- All comments to post --}}

    <ul class="">
        @foreach ($comments->load('post') as $comment)
            <li @if ($loop->last) id="last-comment" @endif x-data class="user-posts border grow">
                @livewire('components.post', ['post' => $comment->post], key($comment->post->id))
            </li>
        @endforeach
    </ul>

    @if ($loadAmount < $totalAmount)
        <x-loading-animation wire:loading>
        </x-loading-animation>
    @endif

    <template id="file-template-modal">
        <li class="block p-1 w-1/2 h-24">
            <article tabindex="0"
                class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                <img alt="upload preview"
                    class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section
                    class="flex flex-col rounded-md text-xs break-words break-all w-full h-full z-20 absolute top-0 py-2 px-3">
                    <h1 class="flex-1 group-hover:text-blue-800"></h1>
                    <div class="flex">
                        <span class="p-1 text-blue-800">
                            <i>
                                <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                </svg>
                            </i>
                        </span>
                        <p class="p-1 size text-xs text-gray-700"></p>
                        <button
                            class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path class="pointer-events-none"
                                    d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                            </svg>
                        </button>
                    </div>
                </section>
            </article>
        </li>
    </template>

    <template id="image-template-modal">
        <li class="block p-1 w-1/2 h-24">
            <article tabindex="0"
                class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section
                    class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                    <h1 class="flex-1"></h1>
                    <div class="flex">
                        <span class="p-1">
                            <i>
                                <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                </svg>
                            </i>
                        </span>

                        <p class="p-1 size text-xs"></p>
                        <button id="submit" dataId="" @click="$wire.deleteImage($el.getAttribute('dataId'))"
                            class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path class="pointer-events-none"
                                    d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                            </svg>
                        </button>
                    </div>
                </section>
            </article>
        </li>
    </template>

    {{-- Autolinker JS Config --}}
    <script>
        $(document).ready(function(e) {
            var open = false;

            $('.postArea').on('input keyup click customEvent', function(e, open) {
                // console.log('working');
                let myLinkedHtml = Autolinker.Autolinker.link($(this).html(), {
                    mention: false,
                    hashtag: 'twitter',
                    className: 'text-blue-600 hover:underline',
                    replaceFn: function(match) {
                        // console.log("href = ", match.getAnchorHref());
                        // console.log("text = ", match.getAnchorText());
                        // console.log((match.getType()));

                        switch (match.getType()) {
                            case 'hashtag':
                                var hashtag = match.getHashtag();
                                // console.log(hashtag);

                                return '<a href="/tags/' + hashtag +
                                    '" class="text-blue-600 hover:underline">#' + hashtag +
                                    '</a>';

                            case 'mention':
                                var mention = match.getMention();
                                // console.log(mention);

                                return '<a href="/user/' + mention + '">@' + mention + '</a>';
                        }
                    }
                });
                // [optional] make sure focus is on the element
                $(this).trigger('focus');
                // select all the content in the element
                if (e.key == ' ' || open) {
                    document.execCommand('selectAll', false, $(this).html(myLinkedHtml))
                    open = false;
                };

                document.getSelection().collapseToEnd();
            });

        })
    </script>

    {{-- File Upload Code --}}
    <script>
        const fileTempl = document.getElementById("file-template-modal"),
            imageTempl = document.getElementById("image-template-modal"),
            empty = document.getElementById("empty");

        // use to store pre selected files
        let FILES = {};

        let filenames = [];
        let i = 0;

        // check if file is of type image and prepend the initialied
        // template to the target element
        function addFile(target, file) {
            const isImage = file.type.match("image.*"),
                objectURL = URL.createObjectURL(file);

            const clone = isImage ?
                imageTempl.content.cloneNode(true) :
                fileTempl.content.cloneNode(true);


            clone.querySelector("h1").textContent = file.name;
            clone.querySelector("li").id = objectURL;
            clone.querySelector(".delete").dataset.target = objectURL;
            clone.querySelector(".delete").setAttribute("dataId", i++);
            clone.querySelector(".size").textContent =
                file.size > 1024 ?
                file.size > 1048576 ?
                Math.round(file.size / 1048576) + "mb" :
                Math.round(file.size / 1024) + "kb" :
                file.size + "b";

            isImage &&
                Object.assign(clone.querySelector("img"), {
                    src: objectURL,
                    alt: file.name
                });

            empty.classList.add("hidden");
            target.prepend(clone);

            FILES[objectURL] = file;
        }

        const galleryModal = document.getElementById("galleryModal"),
            overlay = document.getElementById("overlay");

        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hiddenInput" + @json($post->id));
        document.getElementById("buttonModal").onclick = () => hidden.click();
        hidden.onchange = (e) => {
            e.preventDefault();
            console.log(e.target.files);
            for (const file of e.target.files) {
                addFile(galleryModal, file);
                filenames.push(file.name);
                console.log(file);
            }
        };

        // use to check if a file is being dragged
        const hasFiles = ({
                dataTransfer: {
                    types = []
                }
            }) =>
            types.indexOf("Files") > -1;

        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;

        // reset counter and append file to galleryModal when file is dropped
        function dropHandler(ev) {
            ev.preventDefault();
            for (const file of ev.dataTransfer.files) {
                addFile(galleryModal, file);
                overlay.classList.remove("draggedover");
                counter = 0;
            }
        }

        // only react to actual files being dragged
        function dragEnterHandler(e) {
            e.preventDefault();
            if (!hasFiles(e)) {
                return;
            }
            ++counter && overlay.classList.add("draggedover");
        }

        function dragLeaveHandler(e) {
            1 > --counter && overlay.classList.remove("draggedover");
        }

        function dragOverHandler(e) {
            if (hasFiles(e)) {
                e.preventDefault();
            }
        }

        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        galleryModal.onclick = ({
            target
        }) => {
            if (target.classList.contains("delete")) {
                const ou = target.dataset.target;
                document.getElementById(ou).remove(ou);
                galleryModal.children.length === 1 && empty.classList.remove("hidden");
                var index = filenames.indexOf(FILES[ou].name);
                if (index !== -1) {
                    filenames.splice(index, 1);
                }

                for (let k = 0; k < filenames.length; k++) {
                    $(`button.delete:eq(${k})`).attr('dataId', filenames.length - k);
                    console.log($(`button.delete:eq(${k})`).attr('dataId'));
                }

                delete FILES[ou];
            }
        };

        // print all selected files
        document.getElementById("submitModal").onclick = () => {
            $('.postArea').trigger('customEvent', [true])
            @this.postTags = ($('.postArea').find('a').map(function() {
                if ($(this).text()[0] === '#') {
                    return $.trim($(this).text());
                }
            }).get());

            @this.mentions = ($('.postArea').find('a').map(function() {
                if ($(this).text()[0] === '@') {
                    return $.trim($(this).text());
                }
            }).get());
            while (galleryModal.children.length > 0) {
                galleryModal.lastChild.remove();
            }
            FILES = {};
            filenames = [];
            empty.classList.remove("hidden");
            galleryModal.append(empty);
        };

        // clear entire selection
        // document.getElementById("cancel").onclick = () => {
        //     while (galleryModal.children.length > 0) {
        //         galleryModal.lastChild.remove();
        //     }
        //     FILES = {};
        //     empty.classList.remove("hidden");
        //     galleryModal.append(empty);
        // };
    </script>

    {{-- Alpine Data --}}
    <script>
        window.data = () => {
            return {
                open: false,
            }
        }
    </script>

    {{-- File Upload Styles --}}
    <style>
        .hasImage:hover section {
            background-color: rgba(5, 5, 5, 0.4);
        }

        .hasImage:hover button:hover {
            background: rgba(5, 5, 5, 0.45);
        }

        #overlay p,
        i {
            opacity: 0;
        }

        #overlay.draggedover {
            background-color: rgba(255, 255, 255, 0.7);
        }

        #overlay.draggedover p,
        #overlay.draggedover i {
            opacity: 1;
        }

        .group:hover .group-hover\:text-blue-800 {
            color: #2b6cb0;
        }

    </style>

    {{-- Posts Scroll Load --}}
    <script>
        const lastComment = document.getElementById('last-comment');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            });
        });
        if (Object.keys(@js($comments)).length > 0) observer.observe(lastComment);
    </script>

    {{-- Tribute JS Config --}}
    <script>
        var tributeMultipleTriggers = new Tribute({
            collection: [{
                // The function that gets call on select that retuns the content to insert
                selectTemplate: function(item) {
                    if (this.range.isContentEditable(this.current.element)) {
                        return (
                            '<a href="/users/' + item.original.key + '" title="' +
                            item.original.value +
                            '" class="text-blue-600 hover:underline">@' +
                            item.original.key +
                            "</a>"
                        );
                    }

                    return "@" + item.original.value;
                },
                menuItemTemplate: function(item) {
                    // console.log(item);
                    return '<img class="w-4 h-4 object-cover rounded-full" src="/storage/' + item
                        .original.image + '">' + item.string;
                },
                noMatchTemplate: function() {
                    return null;
                },

                // the array of objects
                values: @json($mentionables)
            }, {
                // The symbol that starts the lookup
                trigger: "#",
                menuItemTemplate: function(item) {
                    return item.string;
                },
                // The function that gets call on select that retuns the content to insert
                selectTemplate: function(item) {
                    if (this.range.isContentEditable(this.current.element)) {
                        return (
                            '<a href="/search/tags/' + encodeURIComponent(item.original.value) +
                            '" title="' +
                            item.original.value +
                            '" class="text-blue-600 hover:underline">' +
                            item.original.value +
                            "</a>"
                        );
                    }
                },

                // function retrieving an array of objects
                values: @json($tags),

                lookup: "value",

                fillAttr: "value",
            }],
            noMatchTemplate: function(item) {
                if (this.current.collection.trigger === "#") {
                    return "<li class = 'noMatches'>No matches found - Tag will be added</li>";
                } else if (this.current.collection.trigger === "@") {
                    return "<li class = 'noMatches'>No matches found</li>";
                }
            }
        })

        // console.log();
        // Autolinker = Autolinker


        tributeMultipleTriggers.attach(document.getElementById("postCom" + @json($post->id)));
    </script>
</div>
