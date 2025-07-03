import { createApp } from 'vue'
import { createPinia } from 'pinia';
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap'
import './style.css'
import router from './router'



import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faCartArrowDown, faArrowTurnUp, faLocationDot, faPhone } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { faCalendar, faComments, faHeart, faUser } from '@fortawesome/free-regular-svg-icons'
import { faShare } from '@fortawesome/free-solid-svg-icons/faShare';
import { faPrint } from '@fortawesome/free-solid-svg-icons/faPrint';



/* add icons to the library */
library.add(faHeart, faCartArrowDown, faFacebookF, faArrowTurnUp, faLocationDot, faPhone, faWhatsapp, faUser, faCalendar, faComments, faShare, faTwitter, faShare, faPrint)


// Create the Vue app and mount it


createApp(App).use(router).use(createPinia).component('font-awesome-icon', FontAwesomeIcon).mount('#app')
