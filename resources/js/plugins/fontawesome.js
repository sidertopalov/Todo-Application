import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faHome,
  faUser,
  faInfoCircle,
  faDoorOpen,
  faGlobeEurope,
  faBars,
  faTimesCircle,
  faSignInAlt,
  faLock,
  faUserPlus,
  faClipboardCheck,
  faClipboardList,
  faPlusCircle
} from '@fortawesome/free-solid-svg-icons'

import {
  faViber
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faHome,
  faUser,
  faInfoCircle,
  faDoorOpen,
  faGlobeEurope,
  faBars,
  faTimesCircle,
  faSignInAlt,
  faLock,
  faUserPlus,
  faClipboardCheck,
  faClipboardList,
  faPlusCircle
)

Vue.component('fa', FontAwesomeIcon)
