import Vue from 'vue'
import _ from 'lodash'
import Users from "./components/Users";
// import VModal from 'vue-js-modal'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import Multiselect from 'vue-multiselect'
import {ValidationObserver, ValidationProvider} from 'vee-validate';
import Notifications from 'vue-notification'

Vue.use(VModal, {dynamicDefault: {draggable: false, resizable: false, adaptive: true}})
Vue.component('multiselect', Multiselect)

Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

import './vaildation/validators'
import './vaildation/locale'

Vue.use(Notifications)

const app = new Vue({
    el: '#app',
    components: {
        Users
    },
    data() {
        return {
            sidebarOpen: false
        }
    }
});
