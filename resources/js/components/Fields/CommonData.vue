<template>
    <div id="common" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <h3 class="font-semibold text-lg text-gray-600">Общие данные сделки</h3>
        <hr class="w-20 border-teal-400 mt-2">
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
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="name" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="name">ФИО клиента<span
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
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="+7(929)999-10-99"/>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="email" rules="required|email|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="email">Основной email<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="livingCity" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="livingCity">Город проживания<span
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
    </div>
</template>

<script>
import {VueMaskDirective} from 'v-mask'

export default {
    name: "CommonData",
    directives: {
        'mask': VueMaskDirective
    },
    props: ['data'],
    data() {
        return {
            messengersList: ['WhatsApp', 'Viber', 'Telegram', 'SMS']
        }
    }
}
</script>

