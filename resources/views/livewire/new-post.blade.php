<div>
    <div class="new-user-post" x-data="{ content: @entangle('postText') }">
        <form wire:submit.prevent='store'>
            @csrf
            <div class="flex">
                <div class="m-2 w-10 py-1">
                    <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . $avatar) }}" alt="">
                </div>
                <div class="relative flex-1 px-2 pt-2 mt-2">
                    <div id='testMultiple' maxlength='255'
                        class='postArea text-left bg-transparent text-gray-400 font-medium text-lg w-full overflow-y-auto h-28 break-all'
                        x-ref="postArea" placeholder="What's happening?"
                        @input|keyup|click='content = $event.target.innerHTML;' name="postTest" wire:ignore></div>
                    <span contenteditable="false" class="absolute px-2 py-1 text-xs text-blueGray-600 right-2 bottom-0">
                        <div x-data="scrollProgress"
                            class="inline-flex items-center justify-center overflow-hidden rounded-full bottom-5 left-5">
                            <!-- Building a Progress Ring: https://css-tricks.com/building-progress-ring-quickly/ -->
                            <svg class="w-5 h-5">
                                <circle class="text-gray-300" stroke-width="3" stroke="currentColor" fill="transparent"
                                    r="10" cx="10" cy="10" />
                                <circle class="text-blue-600" stroke-width="3" :stroke-dasharray="circumference"
                                    :stroke-dashoffset="circumference - percent / 255 * circumference"
                                    stroke-linecap="round" stroke="currentColor" fill="transparent" r="10" cx="10"
                                    cy="10" />
                            </svg>
                        </div>

                    </span>
                    @error('postText')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <ul wire:ignore id="gallery" class="flex flex-1 flex-wrap -m-1">
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
                        <div class="flex-1 text-center px-1 py-1 m-2 justify-center text-gray-500">
                            <div class="w-10">
                                <input wire:ignore id="hidden-input" accept=".jpg, .jpeg, .png"
                                    wire:model.lazy="imageInput" type="file" multiple class="hidden" />
                                <a class="tw-post-links hover:bg-blue-600 hover:text-blue-600 hover:bg-opacity-50"
                                    id="button">
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
                    </div>
                </div>

                <div class="flex-1">
                    <button wire:target='store' id="submit"
                        {{ isset($postText) && !empty($postText) ? '' : 'disabled' }} class="tw-new-post-submit-btn"
                        @click="$refs.postArea.innerHTML = null">
                        New Post
                    </button>
                </div>
            </div>
        </form>
    </div>

    <template id="file-template">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
            <article tabindex="0"
                class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                <img alt="upload preview"
                    class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section
                    class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
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

    <template id="image-template">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
            <article tabindex="0"
                class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section
                    class="flex flex-col rounded-md text-xs break-words break-all w-full h-full z-20 absolute top-0 py-2 px-3">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js"
        integrity="sha512-KJYWC7RKz/Abtsu1QXd7VJ1IJua7P7GTpl3IKUqfa21Otg2opvRYmkui/CXBC6qeDYCNlQZ7c+7JfDXnKdILUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/autolink.js') }}"></script>

    <script>
        const fileTempl = document.getElementById("file-template"),
            imageTempl = document.getElementById("image-template"),
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

        const gallery = document.getElementById("gallery"),
            overlay = document.getElementById("overlay");

        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
            e.preventDefault();
            console.log(e.target.files);
            for (const file of e.target.files) {
                addFile(gallery, file);
                filenames.push(file.name);
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

        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
            ev.preventDefault();
            for (const file of ev.dataTransfer.files) {
                addFile(gallery, file);
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
        gallery.onclick = ({
            target
        }) => {
            if (target.classList.contains("delete")) {
                const ou = target.dataset.target;
                document.getElementById(ou).remove(ou);
                gallery.children.length === 1 && empty.classList.remove("hidden");
                var index = filenames.indexOf(FILES[ou].name);
                if (index !== -1) {
                    filenames.splice(index, 1);
                }

                for (let k = 0; k < filenames.length; k++) {
                    $(`button.delete:eq(${k})`).attr('dataId', filenames.length - k);
                }

                delete FILES[ou];
            }
        };

        // print all selected files
        document.getElementById("submit").onclick = () => {
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
            while (gallery.children.length > 0) {
                gallery.lastChild.remove();
            }
            FILES = {};
            filenames = [];
            empty.classList.remove("hidden");
            gallery.append(empty);
        };
    </script>

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
                menuItemLimit: 5,
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
                            '<a href="/search/' + encodeURIComponent(item.original.value) +
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
                menuItemLimit: 5,
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

        tributeMultipleTriggers.attach(document.querySelectorAll(".postArea"));
    </script>

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
    <script>
        const scrollProgress = () => {
            return {
                init() {
                    $('.postArea').on('keyup', () => {
                        this.percent = Math.round(($('.postArea').text().length / 255) * 100)
                    })
                },
                circumference: 49 * Math.PI,
                percent: 0,
            }
        };
    </script>
</div>
