<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addChild)">
            <ValidationProvider v-slot="{ errors }" name="type" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="type">Вид имущества<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <multiselect id="type"
                             v-model="type"
                             :class="{'invalid': errors.length}"
                             :options="types"
                             :show-labels="false"
                             placeholder="Выберите вид имущества"></multiselect>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="ownership" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="ownership">Вид собственности: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="ownership"
                       v-model="ownership"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="address" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="address">Местонахождение: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="address"
                       v-model="address"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="area" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="area">Площадь <span class="text-gray-500 font-light">(м<sup>2</sup>)</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="area"
                       v-model="area"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="pledge" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="pledge">Сведения о залоге: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="pledge"
                       v-model="pledge"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="basis" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="basis">Основание приобретения: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="basis"
                       v-model="basis"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="cost" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="cost">Стоимость <span class="text-gray-500 font-light">(руб.)</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="cost"
                       v-model="cost"
                       v-currency
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="date" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="imBuyDate">Дата приобретения<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <date-picker id="imBuyDate"
                             v-model="dateComputed"
                             placeholder="22.08.1987"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             prefix-class="custom"
                             type="date"></date-picker>
            </ValidationProvider>
            <div class="mt-6">
                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">{{ editing ? 'Изменить' : 'Добавить' }}
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('AddImmovableForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
import {VueMaskDirective} from 'v-mask'
import moment from "moment";

export default {
    name: "AddImmovableForm",
    directives: {
        'mask': VueMaskDirective
    },
    props: [
        'data'
    ],
    data() {
        return {
            type: this.data?.type || '',
            ownership: this.data?.ownership || '',
            address: this.data?.address || '',
            area: this.data?.area || '',
            pledge: this.data?.pledge || '',
            basis: this.data?.basis || '',
            cost: this.data?.cost || '0 ₽',
            date: this.data?.date || '',
            types: [
                'Гараж',
                'Дача',
                'Жилой дом',
                'Земельный участок',
                'Квартира',
                'Иное',
            ]
        }
    },
    computed: {
        editing() {
            return !!this.data
        },
        dateComputed:{
            get: function () {
                if (this.date) {
                    return moment(this.date).toDate()
                }
            },
            set: function (value) {
                this.date = value
            }
        },
    },
    methods: {
        addChild() {
            let data = {
                type: this.type,
                ownership: this.ownership,
                address: this.address,
                area: this.area,
                pledge: this.pledge,
                basis: this.basis,
                cost: this.cost,
                date: this.date,
            }
            if (!this.editing) {
                this.$parent.$emit('immovableAdded', data)
            } else {
                this.$parent.$emit('immovableEdited', data)
            }

            this.$modal.hide('AddImmovableForm')
        }
    }
}
</script>
