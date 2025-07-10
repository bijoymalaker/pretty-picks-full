import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap'
import './style.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCartArrowDown, faArrowTurnUp, faLocationDot, faPhone } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { faCalendar, faComments, faHeart, faUser } from '@fortawesome/free-regular-svg-icons'
import { faShare } from '@fortawesome/free-solid-svg-icons/faShare';
import { faPrint } from '@fortawesome/free-solid-svg-icons/faPrint';



/* add icons to the library */
library.add(faHeart, faCartArrowDown, faFacebookF, faArrowTurnUp, faLocationDot, faPhone, faWhatsapp, faUser, faCalendar, faComments, faShare, faTwitter, faShare, faPrint)


// Create the Vue app and mount it


createInertiaApp({
    resolve: name => import(`./pages/${name}.vue`),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(createPinia())
            .component('font-awesome-icon', FontAwesomeIcon)
        vueApp.mount(el)
    },
})
