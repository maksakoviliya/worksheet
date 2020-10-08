import Vue from 'vue'
import _ from 'lodash'
import Users from "./components/Users";
// import VModal from 'vue-js-modal'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import Multiselect from 'vue-multiselect'

Vue.use(VModal, { dynamicDefault: { draggable: false, resizable: false, adaptive: true } })
Vue.component('multiselect', Multiselect)

const app = new Vue({
    el: '#app',
    components: {
        Users
    },
    data () {
        return {
            sidebarOpen: false
        }
    }
});
