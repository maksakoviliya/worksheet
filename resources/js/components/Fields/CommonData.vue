<template>
    <ValidationObserver id="common" class="rounded-lg bg-white p-6 mr-6 shadow-md" ref="commonValidationObserver"
                        v-slot="{ invalid, handleSubmit }" tag="div">
        <h3 class="font-semibold text-lg text-gray-600">Общие данные сделки</h3>
        <hr class="w-20 border-teal-400 mt-2">
        <ValidationProvider v-slot="{ errors }" name="filial" rules="required" v-if="!filial">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2 mt-4" for="filial">Филиал<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small></label>
            <multiselect id="filial" v-model="data.filial_id" :class="{'invalid': errors.length}"
                         :options="filials.map(option=>option.id)"
                         :custom-label="value=>filials.find(option=>option.id===value) ? filials.find(option=>option.id===value).name : ''"
                         :show-labels="false"
                         placeholder="Выберите филиал"></multiselect>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="envyID" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="envyID">Ссылка на сделку в Envy<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="envyID"
                   v-model="data.envyID"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="https://envy.com/id45454"/>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="surname" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="surname">Фамилия клиента<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="surname"
                   v-model="data.surname"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="Егоров Антон Андреевич"/>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="name" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="name">Имя клиента<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="name"
                   v-model="data.name"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="Егоров Антон Андреевич"/>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="patronymic" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="patronymic">Отчество клиента<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="patronymic"
                   v-model="data.patronymic"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="Егоров Антон Андреевич"/>
        </ValidationProvider>
        <div class="flex">
            <div class="w-1/2 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="phone" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="phone">Телефон<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="phone"
                           v-model="data.phone"
                           v-mask="'+7 (###) ###-##-##'"
                           @keyup="fillPhone"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="+7(929)999-10-99"/>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="email" :rules="{required: required, email: true, max: 255}"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="email">Основной email: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="email"
                           v-model="data.email"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="name@email.ru"/>
                </ValidationProvider>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="messengers" rules="required|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="messengers">Мессенджеры<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <!--                    <input id="messengers"-->
                    <!--                           v-model="data.messengers"-->
                    <!--                           :class="{'border-red-400 focus:red-400': errors.length}"-->
                    <!--                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"-->
                    <!--                           placeholder=""/>-->
                    <multiselect id="messengers" v-model="data.messengers"
                                 :class="{'invalid': errors.length}"
                                 :multiple="true"
                                 :options="messengersList"
                                 :show-labels="false"
                                 placeholder="Выберите мессенджеры"></multiselect>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="livingCity" rules="required|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="livingCity">Город
                        проживания<span
                            class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                errors[0]
                            }}</small>
                    </label>
                    <input id="livingCity"
                           v-model="data.livingCity"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="Москва"/>
                </ValidationProvider>
            </div>
        </div>
    </ValidationObserver>
</template>

<script>
import {VueMaskDirective} from 'v-mask'
import axios from 'axios'

export default {
    name: "CommonData",
    directives: {
        'mask': VueMaskDirective
    },
    props: {
        data: {
            required: false
        },
        filial: {
            required: false
        },
        token: {
            required: true,
            type: String
        },
        requiredForEmail: {
            required: false,
            default: false
        }
    },
    data() {
        return {
            messengersList: ['WhatsApp', 'Viber', 'Telegram', 'SMS'],
            filials: []
        }
    },
    computed: {
        required() {
            return this.requiredForEmail
        }
    },
    methods: {
        fillPhone(event) {
            if (['8', '7', '+'].includes(event.key) && this.data.phone.length <= 5) {
                this.data.phone = this.data.phone.substr(0, this.data.phone.length - 1)
            }
        },
        async loadFilials() {
            try {
                const {data} = await axios.get('/api/filials', {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    },
                })
                console.log('fdata', data)
                this.filials = data.data
            } catch (e) {
                this.$notify({
                    title: 'Ошибка сервера',
                    text: 'Ошиька при получении списка филиалов',
                    type: 'error'
                })
            }
        }
    },
    mounted() {
        this.loadFilials()
    }
}
</script>

