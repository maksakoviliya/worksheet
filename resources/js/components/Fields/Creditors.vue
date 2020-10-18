<template>
    <div id="creditors" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Кредиторы</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="button" @click="showAddCreditorForm">Добавить
            </button>
        </div>
        <template v-if="data.creditors.length">
            <div class="mt-4">
                <vuetable
                    ref="creditors"
                    :api-mode="false"
                    :css="classes.table"
                    :data="data.creditors"
                    :fields="fields"
                >
                    <div slot="actions" slot-scope="props">
                        <button class="bg-gray-300 text-gray-600 p-1 rounded-lg hover:bg-gray-400 text-gray-700 focus:outline-none"
                                @click="data.creditors.splice(props.rowIndex, 1)">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                                <path
                                    d="M300 0h-88c-24.262 0-44 19.738-44 44v36h-56c-35.29 0-64 28.71-64 64 0 32.579 24.475 59.531 56 63.482V448c0 35.29 28.71 64 64 64h176c35.29 0 64-28.71 64-64V207.482c31.525-3.952 56-30.903 56-63.482 0-35.29-28.71-64-64-64h-56V44c0-24.262-19.738-44-44-44zm-84 48h80v32h-80zm144 400c0 8.822-7.178 16-16 16H168c-8.822 0-16-7.178-16-16V208h208zm56-304c0 8.822-7.178 16-16 16H112c-8.822 0-16-7.178-16-16s7.178-16 16-16h288c8.822 0 16 7.178 16 16z"/>
                                <path
                                    d="M208 400c13.255 0 24-10.745 24-24v-96c0-13.255-10.745-24-24-24s-24 10.745-24 24v96c0 13.255 10.745 24 24 24zM304 400c13.255 0 24-10.745 24-24v-96c0-13.255-10.745-24-24-24s-24 10.745-24 24v96c0 13.255 10.745 24 24 24z"/>
                            </svg>
                        </button>
                    </div>
                </vuetable>
            </div>
            <h3 class="font-semibold text-gray-600 mt-4">Итоги по кредитам</h3>
            <hr class="w-20 border-gray-400 mt-2">
            <p class="text-gray-800 mt-4 text-sm">Общая сумма кредитов: <span
                class="text-gray-500 font-semibold text-base">{{ totalSum }}</span></p>
            <p class="text-gray-800 mt-1 text-sm">Ежемесячный платеж по всем кредитам: <span
                class="text-gray-500 font-semibold text-base">{{ totalMonthly }}</span></p>
            <ValidationObserver ref="creditorsValidationObserver" tag="div">
                <ValidationProvider v-slot="{ errors }" class="mt-4" name="nextPayment" rules="required|max:255"
                                    tag="div">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="nextPayment">Дата ближайшего
                        платежа по кредиту<span
                            class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                errors[0]
                            }}</small>
                    </label>
                    <div class="w-1/3 pr-2">
                        <date-picker id="nextPayment"
                                     v-model="data.nextPayment"
                                     :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                                     format="DD.MM.YYYY"
                                     placeholder="22.08.1987"
                                     prefix-class="custom"
                                     type="date"></date-picker>
                    </div>
                </ValidationProvider>
            </ValidationObserver>
        </template>
        <div v-else class="mt-4 text-gray-500 font-light">Нет данных</div>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";
import UsersCreateForm from "../UsersCreateForm";
import AddCreditorForm from "./forms/AddCreditorForm";

export default {
    name: "Creditors",
    components: {
        Vuetable,
    },
    props: ['data'],
    data() {
        return {
            classes: {
                table: {
                    tableWrapper: 'rounded overflow-hidden border border-gray-200',
                    tableHeaderClass: 'table-header',
                    tableBodyClass: 'min-w-full users-table',
                    tableClass: '',
                    loadingClass: 'loading',
                    ascendingIcon: 'blue chevron up icon',
                    descendingIcon: 'blue chevron down icon',
                    ascendingClass: 'sorted-asc',
                    descendingClass: 'sorted-desc',
                    sortableIcon: 'grey sort icon',
                    handleIcon: 'grey sidebar icon',
                },
            },
            banks: [
                {id: 1, name: 'Сбер'},
                {id: 2, name: 'ВТБ'},
                {id: 3, name: 'МКБ'},
                {id: 4, name: 'Тинькоф Банк'},
            ],
            fields: [
                {
                    name: 'bank',
                    title: 'Банк',
                    formatter: value => {
                        return this.banks.find(bank => bank.id === value).name
                    }
                },
                {
                    name: 'type',
                    title: 'Тип кредита'
                },
                {
                    name: 'total',
                    title: 'Сумма кредита',
                },
                {
                    name: 'current',
                    title: 'Текущая задолженность'
                },
                {
                    name: 'monthly',
                    title: 'Ежемесячный платеж'
                },
                {
                    name: 'delay',
                    title: 'Просрочка (мес)'
                },
                {
                    name: 'comment',
                    title: 'Комментарий'
                },
                {
                    name: 'actions',
                    title: '',
                    dataClass: "text-right",
                }
            ]
        }
    },
    computed: {
        totalSum() {
            return new Intl.NumberFormat('ru-RU', {
                style: 'currency',
                currency: 'RUB',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(_.sumBy(this.data.creditors, c => this.$ci.parse(c.total, {
                currency: "RUB",
                precision: 0,
            })))
        },
        totalMonthly() {
            return new Intl.NumberFormat('ru-RU', {
                style: 'currency',
                currency: 'RUB',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(_.sumBy(this.data.creditors, c => this.$ci.parse(c.monthly, {
                currency: "RUB",
                precision: 0,
            })))
        }
    },
    methods: {
        showAddCreditorForm() {
            this.$modal.show(
                AddCreditorForm,
                {},
                {classes: 'lg:ml-32', height: 'auto', name: 'AddCreditorForm'},
                {
                    'creditorAdded': (creditor) => {
                        this.data.creditors.push(creditor)
                    }
                }
            )
        }
    }
}
</script>
