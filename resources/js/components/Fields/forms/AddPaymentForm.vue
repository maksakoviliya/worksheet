<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addPayment)">
            <ValidationProvider v-slot="{ errors }" name="filial" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="filial">Филиал<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="filial"
                       v-model="filial"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="manager" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="manager">Менеджер<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="manager"
                       v-model="manager"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="budget" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="budget">Бюджет<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="budget"
                       v-model="budget"
                       v-currency
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="monthly" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="monthly">Сумма ежемесячного
                    платежа<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                </label>
                <input id="monthly"
                       v-model="monthly"
                       v-currency
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="installment" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="installment">Срок рассрочки <span
                    class="text-gray-500 font-light">(мес)</span><span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="installment"
                       v-model="installment"
                       v-mask="'###'"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="date" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="paymentDate">Дата платежа
                    рассрочки<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                </label>
                <date-picker id="paymentDate"
                             v-model="paymentDateComputed"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             placeholder="22.08.1987"
                             prefix-class="custom"
                             type="date"></date-picker>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="online" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="online">Онлайн продажа<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>

                <label class="flex items-center cursor-pointer" for="online">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="online ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="online" v-model="online" class="absolute opacity-0 w-0 h-0" type="checkbox"/>
                      </span>
                    </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex"><span class="text-gray-500">({{
                            online ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </ValidationProvider>
            <div class="mt-6">
                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">Добавить
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('AddPaymentForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
import {VueMaskDirective} from 'v-mask'
import moment from "moment";

export default {
    name: "AddPaymentForm",
    directives: {
        'mask': VueMaskDirective
    },
    props: [
        'data'
    ],
    data() {
        return {
            filial: this.data?.filial || '',
            manager: this.data?.manager || '',
            budget: this.data?.budget || '0 ₽',
            monthly: this.data?.monthly || '0 ₽',
            installment: this.data?.installment || '',
            paymentDate: this.data?.paymentDate || '',
            online: this.data?.online || false,
        }
    },
    computed: {
        editing() {
            return !!this.data
        },
        paymentDateComputed: {
            get: function () {
                if (this.paymentDate) {
                    return moment(this.paymentDate).toDate()
                }
            },
            set: function (value) {
                this.paymentDate = value
            }
        },
    },
    methods: {
        addPayment() {
            let data = {
                filial: this.filial,
                manager: this.manager,
                budget: this.budget,
                monthly: this.monthly,
                installment: this.installment,
                paymentDate: this.paymentDate,
                online: this.online,
            }
            if (!this.editing) {
                this.$parent.$emit('paymentAdded', data)
            } else {
                this.$parent.$emit('paymentEdited', data)
            }
            this.$modal.hide('AddPaymentForm')
        }
    }
}
</script>
