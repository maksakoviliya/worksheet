<template>
    <ValidationObserver id="passport" ref="passportValidationObserver" v-slot="{ invalid, handleSubmit }"
                        class="rounded-lg bg-white p-6 mr-6 shadow-md" tag="div">
        <h3 class="font-semibold text-lg text-gray-600">Паспортные данные</h3>
        <hr class="w-20 border-teal-400 mt-2">
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="birthday"
                            :rules="{required: required, max: 255, is_not: 'Invalid date'}" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="birthday">Дата рождения: <small
                v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>

            <div class="w-1/3 pr-2">
                <date-picker id="birthday"
                             v-model="birthday"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             placeholder="22.08.1987"
                             prefix-class="custom"
                             type="date"></date-picker>
            </div>
        </ValidationProvider>
        <h3 class="font-semibold text-gray-600 mt-4">Паспорт</h3>
        <hr class="w-20 border-gray-400 mt-2">
        <div class="flex">
            <div class="w-1/3 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="series"
                                    :rules="{required: required, max: 255}" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="series">Серия: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="series"
                           v-model="data.series"
                           v-mask="'####'"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="7765"/>
                </ValidationProvider>
            </div>
            <div class="w-2/3">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="number"
                                    :rules="{required: required, max: 255}" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="number">Номер: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="number"
                           v-model="data.number"
                           v-mask="'######'"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="456784"/>
                </ValidationProvider>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="issued"
                                    :rules="{required: required, max: 255}" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="issued">Дата выдачи: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <date-picker id="issued"
                                 v-model="issued"
                                 :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                                 format="DD.MM.YYYY"
                                 placeholder="22.08.1987"
                                 prefix-class="custom"
                                 type="date"></date-picker>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="code" :rules="{required: required, max: 255}"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="code">Код подразделения:
                        <small v-if="errors[0]" class="text-red-400">{{
                                errors[0]
                            }}</small>
                    </label>
                    <input id="code"
                           v-model="data.code"
                           v-mask="'###-###'"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="114-444"/>
                </ValidationProvider>
            </div>
        </div>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="issuedBy" :rules="{required: required, max: 255}"
                            tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="issuedBy">Кем выдан: <small
                v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <textarea id="issuedBy" v-model="data.issuedBy"
                      :class="{'border-red-400 focus:red-400': errors.length}"
                      class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                      name="issuedBy"
                      placeholder="Управлением ФМС по городу Москва"></textarea>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="born" :rules="{required: required, max: 255}"
                            tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="born">Место рождения: <small
                v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <textarea id="born" v-model="data.born"
                      :class="{'border-red-400 focus:red-400': errors.length}"
                      class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                      name="issuedBy"
                      placeholder="г. Москва, ул. Крыжовниковая, д. 7, корп. 4, кв. 15"></textarea>
        </ValidationProvider>
        <h3 class="font-semibold text-gray-600 mt-4">Регистрация</h3>
        <hr class="w-20 border-gray-400 mt-2">
        <div class="flex">
            <div class="w-1/2 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="index"
                                    :rules="{required: required, max: 255}" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="index">Индекс: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="index"
                           v-model="data.index"
                           v-mask="'######'"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="089887"/>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="region" rules="max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="region">Регион: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="region"
                           v-model="data.region"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="Владимирская область"/>
                </ValidationProvider>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="area" rules="max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="area">Район: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="area"
                           v-model="data.area"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="Серпуховский район"/>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="city" :rules="{required: required, max: 255}"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="city">Город <span
                        class="text-sm text-gray-500 font-light">(Населенный пункт)</span>: <small v-if="errors[0]"
                                                                                                   class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="city"
                           v-model="data.city"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="Ярославль"/>
                </ValidationProvider>
            </div>
        </div>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="street" :rules="{required: required, max: 255}"
                            tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="street">Улица: <small v-if="errors[0]"
                                                                                                        class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="street"
                   v-model="data.street"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="Маринченко"/>
        </ValidationProvider>
        <div class="flex">
            <div class="w-1/3 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="house"
                                    :rules="{required: required, max: 255}" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="house">Дом: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="house"
                           v-model="data.house"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder=""/>
                </ValidationProvider>
            </div>
            <div class="w-1/3 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="housing" rules="max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="housing">Корпус: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="housing"
                           v-model="data.housing"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder=""/>
                </ValidationProvider>
            </div>
            <div class="w-1/3">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="room" rules="max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="room">Квартира: <small
                        v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="room"
                           v-model="data.room"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder=""/>
                </ValidationProvider>
            </div>
        </div>
        <hr class="w-20 border-gray-400 mt-8">
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="registration" rules="max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="registration">Адрес регистрации:
                <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
            </label>
            <textarea id="registration" v-model="data.registration"
                      :class="{'border-red-400 focus:red-400': errors.length}"
                      class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                      name="registration"
                      placeholder="133322, г. Смоленск, ул. Кравченко, д. 33, корп. 3, кв. 765"></textarea>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="post" rules="max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="post">Почтовый адрес: <small
                v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <div class="relative">
                <button
                    :class="data.registration.length ? 'bg-gray-300' : 'pointer-events-none cursor-not-allowed bg-gray-100 text-gray-600'"
                    class="hover:bg-gray-400 focus:outline-none absolute right-0 top-0 mt-2 mr-2 p-1 rounded-lg"
                    @click="data.post = data.registration">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 561 561">
                        <path
                            d="M395.25 0h-306c-28.05 0-51 22.95-51 51v357h51V51h306V0zm76.5 102h-280.5c-28.05 0-51 22.95-51 51v357c0 28.05 22.95 51 51 51h280.5c28.05 0 51-22.95 51-51V153c0-28.05-22.95-51-51-51zm0 408h-280.5V153h280.5v357z"/>
                    </svg>
                </button>
                <textarea id="post" v-model="data.post"
                          :class="{'border-red-400 focus:red-400': errors.length}"
                          class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                          name="post"
                          placeholder="456634, г. Йошкар - Ола, ул. Малько, д. 12"></textarea></div>
        </ValidationProvider>
    </ValidationObserver>
</template>

<script>
import {VueMaskDirective} from "v-mask";
import moment from "moment";

export default {
    name: "Passport",
    directives: {
        'mask': VueMaskDirective
    },
    props: {
        data: {
            required: false
        },
        requiredForEmail: {
            required: false,
            default: false
        }
    },
    computed: {
        birthday: {
            get: function () {
                return this.data.birthday ? moment.utc(this.data.birthday).toDate() : null
            },
            set: function (value) {
                this.data.birthday = value
            }
        },
        issued: {
            get: function () {
                if (this.data.birthday)
                    return moment(this.data.issued).toDate()
                return null
            },
            set: function (value) {
                this.data.issued = value
            }
        },
        required() {
            return this.requiredForEmail
        }
    }
}
</script>

<style scoped>

</style>
