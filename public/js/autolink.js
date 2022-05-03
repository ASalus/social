$(document).ready(function (e) {
    var open = false;

    $('.postArea').on('input keyup click customEvent', function (e, open) {
        // console.log('working');
        let myLinkedHtml = Autolinker.Autolinker.link($(this).html(), {
            mention: false,
            hashtag: 'twitter',
            className: 'text-blue-600 hover:underline',
            replaceFn: function (match) {
                // console.log("href = ", match.getAnchorHref());
                // console.log("text = ", match.getAnchorText());
                // console.log((match.getType()));

                switch (match.getType()) {
                    case 'hashtag':
                        var hashtag = match.getHashtag();
                        // console.log(hashtag);

                        return '<a href="/search/%23' + hashtag + '" class="text-blue-600 hover:underline">#' + hashtag + '</a>';

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

    $('.postArea').on('keydown paste', function (event) {
        // console.log($(this).text());
        // console.log($(this).text().length);
        if ($(this).text().length === 255 && event.keyCode != 8) {
            event.preventDefault();
        }
    });
})