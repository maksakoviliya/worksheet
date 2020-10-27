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
                        <button
                            class="bg-gray-300 text-gray-600 p-1 rounded-lg hover:bg-gray-400 text-gray-700 focus:outline-none"
                            @click="showEditCreditorForm(props.rowIndex)">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 64.954 64.954">
                                <path
                                    d="M63.591 10.201l-8.835-8.833A4.628 4.628 0 0051.462 0h-.004a4.628 4.628 0 00-3.293 1.363L4.287 45.243c-.484.409-.85.965-.998 1.63L.072 61.301a3 3 0 003.581 3.581l14.429-3.217a2.978 2.978 0 001.636-1.006l43.873-43.872a4.662 4.662 0 000-6.586zm-20.919 5.141l6.939 6.938-27.02 27.021-6.938-6.938 27.019-27.021zM8.947 49.068l2.463-2.463 6.938 6.938-2.465 2.465-8.927 1.99 1.991-8.93zm44.907-31.03l-6.939-6.939 4.544-4.543 6.94 6.938-4.545 4.544z"/>
                            </svg>
                        </button>
                        <button
                            class="bg-gray-300 text-gray-600 p-1 rounded-lg hover:bg-gray-400 text-gray-700 focus:outline-none"
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
                                     v-model="nextPayment"
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
import AddCreditorForm from "./forms/AddCreditorForm";
import moment from "moment";

export default {
    name: "Creditors",
    components: {
        Vuetable,
    },
  props: {
    data: {
      required: false
    },
    token: {
      required: true,
      type: String
    },
  },
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
                },
                {
                    name: 'type',
                    title: 'Тип кредита'
                },
                {
                    name: 'total',
                    title: 'Сумма кредита',
                    formatter: value => {
                        if (this.$ci.parse(value, {
                            currency: "RUB",
                            precision: 0,
                        })) {
                            return new Intl.NumberFormat('ru-RU', {
                                style: 'currency',
                                currency: 'RUB',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(this.$ci.parse(value, {
                                precision: 0,
                            }))
                        }
                    }
                },
                {
                    name: 'current',
                    title: 'Текущая задолженность',
                    formatter: value => {
                        if (this.$ci.parse(value, {
                            currency: "RUB",
                            precision: 0,
                        })) {
                            return new Intl.NumberFormat('ru-RU', {
                                style: 'currency',
                                currency: 'RUB',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(this.$ci.parse(value, {
                                precision: 0,
                            }))
                        }
                    }
                },
                {
                    name: 'monthly',
                    title: 'Ежемесячный платеж',
                    formatter: value => {
                        if (this.$ci.parse(value, {
                            currency: "RUB",
                            precision: 0,
                        })) {
                            return new Intl.NumberFormat('ru-RU', {
                                style: 'currency',
                                currency: 'RUB',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(this.$ci.parse(value, {
                                precision: 0,
                            }))
                        }
                    }
                },
                {
                    name: 'delay',
                    title: 'Просрочка (мес)'
                },
                {
                    name: 'comment',
                    title: 'Комментарий',
                    formatter: value => _.truncate(value)
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
            }).format(_.sumBy(this.data.creditors, c => {
                return this.$ci.parse(c.total, {
                    currency: "RUB",
                    precision: 0,
                })
            }))
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
        },
        nextPayment: {
            get: function () {
                return moment(this.data.nextPayment).toDate()
            },
            set: function (value) {
                this.data.nextPayment = value
            }
        },
    },
    methods: {
        showAddCreditorForm() {
            this.$modal.show(
                AddCreditorForm,
                {token: this.token},
                {classes: 'lg:ml-32', height: 'auto', name: 'AddCreditorForm'},
                {
                    'creditorAdded': (creditor) => {
                        this.data.creditors.push(creditor)
                    }
                }
            )
        },
        showEditCreditorForm(index) {
            this.$modal.show(
                AddCreditorForm,
                {token: this.token, data: this.data.creditors[index]},
                {classes: 'lg:ml-32', height: 'auto', name: 'AddCreditorForm'},
                {
                    'creditorEdited': (creditor) => {
                        this.data.creditors.splice(index, 1, creditor)
                    }
                }
            )
        }
    }
}
</script>
