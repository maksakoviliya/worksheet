<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addChild)">
            <ValidationProvider v-slot="{ errors }" name="object" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="object">Объект<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="object"
                       v-model="object"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="date" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="date">Дата оспоримой сделки<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
              <date-picker id="date"
                           v-model="dateComputed"
                           placeholder="22.08.1987"
                           :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                           format="DD.MM.YYYY"
                           prefix-class="custom"
                           type="date"></date-picker>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="cost" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="cost">Стоимость<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
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
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="money" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="money">Куда потрачены деньги<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="money"
                       v-model="money"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
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
                    type="button" @click="$modal.hide('AddVoidableForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
import {VueMaskDirective} from 'v-mask'
import moment from "moment";

export default {
    name: "AddVoidableForm",
    directives: {
        'mask': VueMaskDirective
    },
    props: [
        'data'
    ],
    data() {
        return {
            object: this.data?.object || '',
            date: this.data?.date || '',
            cost: this.data?.cost || '0 ₽',
            money: this.data?.money || '',
        }
    },
    computed: {
        editing() {
            return !!this.data
        },
        dateComputed: {
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
                object: this.object,
                date: this.date,
                cost: this.cost,
                money: this.money
            }
            if (!this.editing) {
                this.$parent.$emit('voidableAdded', data)
            } else {
                this.$parent.$emit('voidableEdited', data)
            }
            this.$modal.hide('AddVoidableForm')
        }
    }
}
</script>
