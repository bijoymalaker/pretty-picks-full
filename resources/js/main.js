import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import { createPinia } from 'pinia';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap'
import './style.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCartArrowDown, faArrowTurnUp, faLocationDot, faPhone, faCartPlus } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { faCalendar, faComments, faHeart, faUser } from '@fortawesome/free-regular-svg-icons'
import { faShare } from '@fortawesome/free-solid-svg-icons/faShare';
import { faPrint } from '@fortawesome/free-solid-svg-icons/faPrint';

import NProgress from 'nprogress'
import 'nprogress/nprogress.css'


// Custom NProgress color
const nprogressCustomStyle = document.createElement('style')
nprogressCustomStyle.innerHTML = `
#nprogress .bar {
  background: #ff2222 !important; /* Change this to your desired color */
}
#nprogress .peg {
  box-shadow: 0 0 10px #ff2222, 0 0 5px #ff2222 !important;
}
#nprogress .spinner-icon {
  border-top-color: #ff2222 !important;
  border-left-color: #ff2222 !important;
}
`
document.head.appendChild(nprogressCustomStyle)

/* add icons to the library */
library.add(faHeart, faCartArrowDown, faFacebookF, faArrowTurnUp, faLocationDot, faPhone, faWhatsapp, faUser, faCalendar, faComments, faShare, faTwitter, faShare, faPrint, faCartPlus)

// Inertia progress bar
NProgress.configure({ showSpinner: false })
router.on('start', () => NProgress.start())
router.on('finish', () => NProgress.done())
router.on('error', () => NProgress.done())

// Create the Vue app and mount it


createInertiaApp({
    resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
    return pages[`./pages/${name}.vue`];
  },
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(createPinia())
            .component('font-awesome-icon', FontAwesomeIcon)
        vueApp.mount(el)
    },
})
