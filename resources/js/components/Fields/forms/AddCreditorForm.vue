<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addCreditor)">
            <ValidationProvider v-slot="{ errors }" name="bank" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="bank">Банк<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <multiselect id="bank" v-model="bank"
                             :class="{'invalid': errors.length}"
                             :custom-label=" opt => banks.find(bank => bank.id === opt).name"
                             :options="banks.map(bank => bank.id)"
                             :show-labels="false"
                             placeholder="Выберите банк"></multiselect>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="type" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="type">Тип кредита<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <multiselect id="type" v-model="type"
                             :class="{'invalid': errors.length}"
                             :options="types"
                             :show-labels="false"
                             placeholder="Выберите тип кредита"></multiselect>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="total" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="total">Сумма кредита<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input
                    id="total"
                    v-model="total"
                    type="text"
                    v-currency
                    :class="{'border-red-400 focus:red-400': errors.length}"
                    class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                    placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="current" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="current">Текущая
                    задолженность<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                </label>
                <input
                    id="current"
                    v-model="current"
                    v-currency
                    :class="{'border-red-400 focus:red-400': errors.length}"
                    class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                    placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="monthly" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="monthly">Ежемесячный платеж<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input
                    id="monthly"
                    v-model="monthly"
                    v-currency
                    :class="{'border-red-400 focus:red-400': errors.length}"
                    class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                    placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="delay" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="delay">Просрочка (мес)<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="delay"
                       v-model="delay"
                       v-mask="'###'"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="comment" rules="max:500" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="comment">Комментарий: <small
                    v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <textarea id="comment" v-model="comment"
                          :class="{'border-red-400 focus:red-400': errors.length}"
                          class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                          name="comment"
                          placeholder=""></textarea>
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
                    type="button" @click="$modal.hide('AddCreditorForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>

<script>
import {VueMaskDirective} from "v-mask";
// import VueCurrencyInput from 'vue-currency-input'

export default {
    name: "AddCreditorForm",
    props: [
        'data'
    ],
    data() {
        return {
            bank: this.data.bank || '',
            type: this.data.type || '',
            total: this.data.total || 0,
            current: this.data.current || 0,
            monthly: this.data.monthly || 0,
            delay: this.data.delay || '',
            comment: this.data.comment || '',
            banks: [
                {id: 1, name: 'Сбер'},
                {id: 2, name: 'ВТБ'},
                {id: 3, name: 'МКБ'},
                {id: 4, name: 'Тинькоф Банк'},
            ],
            types: [
                'Потреб. кредит',
                'Кредитная карта',
                'Ипотека',
                'Залоговый кредит',
                'Автокредит',
                'МФО'
            ]
        }
    },
    directives: {
        'mask': VueMaskDirective
    },
    computed: {
        editing() {
            return !!this.data
        }
    },
    methods: {
        addCreditor() {
            let data = {
                bank: this.banks.find(bank => bank.id === this.bank).id,
                type: this.type,
                total: this.total,
                current: this.current,
                monthly: this.monthly,
                delay: this.delay,
                comment: this.comment
            }
            if (!this.editing) {
                this.$parent.$emit('creditorAdded', data)
            } else {
                this.$parent.$emit('creditorEdited', data)
            }

            this.$modal.hide('AddCreditorForm')
        }
    }
}
</script>
