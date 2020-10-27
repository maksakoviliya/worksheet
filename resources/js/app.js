import Vue from 'vue'
import _ from 'lodash'
import Users from "./components/Users";
// import VModal from 'vue-js-modal'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import Multiselect from 'vue-multiselect'
import {ValidationObserver, ValidationProvider} from 'vee-validate';
import Notifications from 'vue-notification'
import VueMask from 'v-mask'


Vue.use(VModal, {dynamicDefault: {draggable: false, resizable: false, adaptive: true}})
Vue.component('multiselect', Multiselect)

Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);


import './vaildation/validators'
import './vaildation/locale'
import Worksheets from "./components/Worksheets";
import Worksheet from "./components/Worksheet";

import VueScrollactive from 'vue-scrollactive';

Vue.use(VueScrollactive);

Vue.use(Notifications)

import VueCurrencyInput from 'vue-currency-input'

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/locale/ru';
import VoidableWorksheets from "./components/VoidableWorksheets";
import VoidableCreate from "./components/VoidableCreate";
import Banks from "./components/banks/Banks";
import BankUploader from "./components/banks/BankUploader";

Vue.component('date-picker', DatePicker)


Vue.use(VueCurrencyInput, {
    globalOptions: {
        currency: "RUB",
        precision: 0,
        distractionFree: false
    },
})

const app = new Vue({
    el: '#app',
    components: {
        Users,
        Worksheets,
        Worksheet,
        VoidableWorksheets,
        VoidableCreate,
        Banks,
        BankUploader
    },
    data() {
        return {
            sidebarOpen: false
        }
    }
});
