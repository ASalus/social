require('./bootstrap');

import Scroll from '@alpine-collective/toolkit-scroll'
import Truncate from '@alpine-collective/toolkit-truncate'
import Range from '@alpine-collective/toolkit-range'
import Alpine from 'alpinejs'


window.Alpine = Alpine
window.Alpine.plugin(Scroll)
window.Alpine.plugin(Truncate)
window.Alpine.plugin(Range)

window.Alpine.start()


$('.postArea').on('input keyup', function (e) {
    var myLinkedHtml = Autolinker.link($(this).html(), {
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

                    return '<a href="/tags/' + hashtag + '" class="text-blue-600 hover:underline">#' + hashtag + '</a>';

                case 'mention':
                    var mention = match.getMention();
                    // console.log(mention);

                    return '<a href="/user/' + mention + '">@' + mention + '</a>';
            }
        }
    });
    // [optional] make sure focus is on the element
    $(this).focus();
    // select all the content in the element
    if (e.key == ' ') document.execCommand('selectAll', false, $(this).html(myLinkedHtml));
    // collapse selection to the end
    document.getSelection().collapseToEnd();

    console.log($(this).html())

    // if (e.key == " ") {
    //     $(this).html(myLinkedHtml)
    // }
});