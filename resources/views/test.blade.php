<html>

<head>
    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

    @livewire('livewire-ui-modal')
    @livewireScripts

    <script src="{{ asset('js/app.js') }}"></script>

    <div>
        <p id="redaaqq" contenteditable="true" placeholder="redhot" class="focus:border-2 ">asdasdasd</p>
    </div>
    <script>


        Autolinker = Autolinker.Autolinker

        $('#redaaqq').on('input', function() {
            // console.log($('#redaaqq').html());
            var myLinkedHtml = Autolinker.link($('#redaaqq').html(), {
                mention: 'twitter'
                , hashtag: 'twitter'
                , replaceFn: function(match) {
                    // console.log("href = ", match.getAnchorHref());
                    // console.log("text = ", match.getAnchorText());
                    // console.log((match.getType()));

                    switch (match.getType()) {
                        case 'hashtag':
                            var hashtag = match.getHashtag();
                            // console.log(hashtag);

                            return '<a href="/tags/' + hashtag + '">' + hashtag + '</a>';

                        case 'mention':
                            var mention = match.getMention();
                            // console.log(mention);

                            return '<a href="/user/' + mention + '">' + mention + '</a>';
                    }
                }
            });

        });

    </script>
</body>

</html>
