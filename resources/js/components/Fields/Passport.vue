<template>
    <div id="passport" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <h3 class="font-semibold text-lg text-gray-600">Паспортные данные</h3>
        <hr class="w-20 border-teal-400 mt-2">
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="birthday" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="birthday">Дата рождения<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <input id="birthday"
                   v-model="data.birthday"
                   v-mask="'##.##.####'"
                   :class="{'border-red-400 focus:red-400': errors.length}"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="22.08.1987"/>
        </ValidationProvider>
        <h3 class="font-semibold text-gray-600 mt-4">Паспорт</h3>
        <hr class="w-20 border-gray-400 mt-2">
        <div class="flex">
            <div class="w-1/3 mr-4">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="series" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="series">Серия<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="number" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="number">Номер<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="issued" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="issued">Дата выдачи<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="issued"
                           v-model="data.issued"
                           v-mask="'##.##.####'"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="22.08.1987"/>
                </ValidationProvider>
            </div>
            <div class="w-1/2">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="code" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="code">Код подразделения<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="issuedBy" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="issuedBy">Кем выдан<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                    errors[0]
                }}</small>
            </label>
            <textarea id="issuedBy" v-model="data.issuedBy"
                      :class="{'border-red-400 focus:red-400': errors.length}"
                      class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                      name="issuedBy"
                      placeholder="Управлением ФМС по городу Москва"></textarea>
        </ValidationProvider>
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="born" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="born">Место рождения<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="index" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="index">Индекс<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="region" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="region">Регион<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="area" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="area">Район<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="city" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="city">Город <span
                        class="text-sm text-gray-500 font-light">(Населенный пункт)</span><span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
        <ValidationProvider v-slot="{ errors }" class="mt-4" name="street" rules="required|max:255" tag="div">
            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="street">Улица<span
                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="house" rules="required|max:255" tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="house">Дом<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="housing" rules="required|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="housing">Корпус<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="room" rules="required|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="room">Квартира<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
    </div>
</template>

<script>
import {VueMaskDirective} from "v-mask";

export default {
    name: "Passport",
    directives: {
        'mask': VueMaskDirective
    },
    data() {
        return {
            data: {
                birthday: '',
                series: '',
                number: '',
                issued: '',
                code: '',
                issuedBy: '',
                born: '',
                region: '',
                area: '',
                city: '',
                street: '',
                house: '',
                housing: '',
                room: ''
            }
        }
    }
}
</script>

<style scoped>

</style>
