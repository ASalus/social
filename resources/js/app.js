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
