<template>
    <div id="income" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Данные по оплате</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="button" @click="showAddPaymentForm">Добавить
            </button>
        </div>
        <template v-if="data.payment.length">
            <div class="mt-4">
                <vuetable
                    ref="payment"
                    :api-mode="false"
                    :css="classes.table"
                    :data="data.payment"
                    :fields="fields"
                >
                    <div slot="actions" slot-scope="props">
                        <button
                            class="bg-gray-300 text-gray-600 p-1 rounded-lg hover:bg-gray-400 text-gray-700 focus:outline-none"
                            @click="showEditPaymentForm(props.rowIndex)">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 64.954 64.954">
                                <path
                                    d="M63.591 10.201l-8.835-8.833A4.628 4.628 0 0051.462 0h-.004a4.628 4.628 0 00-3.293 1.363L4.287 45.243c-.484.409-.85.965-.998 1.63L.072 61.301a3 3 0 003.581 3.581l14.429-3.217a2.978 2.978 0 001.636-1.006l43.873-43.872a4.662 4.662 0 000-6.586zm-20.919 5.141l6.939 6.938-27.02 27.021-6.938-6.938 27.019-27.021zM8.947 49.068l2.463-2.463 6.938 6.938-2.465 2.465-8.927 1.99 1.991-8.93zm44.907-31.03l-6.939-6.939 4.544-4.543 6.94 6.938-4.545 4.544z"/>
                            </svg>
                        </button>
                        <button @click="data.payment.splice(props.rowIndex, 1)"
                                class="bg-gray-300 text-gray-600 p-1 rounded-lg hover:bg-gray-400 text-gray-700 focus:outline-none">
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
        </template>
        <div v-else class="mt-4 text-gray-500 font-light">Нет данных</div>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";
import AddPaymentForm from "./forms/AddPaymentForm";
import moment from "moment";
import axios from "axios";

export default {
    name: "Payment",
    components: {
        Vuetable
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
            managers: [],
            fields: [
                {
                    name: 'manager',
                    title: 'Менеджер',
                    formatter: value => {
                        let manager = this.managers.find(item => item.id === value)
                        return manager ? manager.name : ' - '
                    }
                },
                {
                    name: 'budget',
                    title: 'Бюджет',
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
                    name: 'installment',
                    title: 'Срок рассрочки (мес)'
                },
                {
                    name: 'paymentDate',
                    title: 'Дата платежа рассрочки',
                    formatter: value => {
                        return moment(value).format('DD.MM.YYYY')
                    }
                },
                {
                    name: 'online',
                    title: 'Онлайн продажа',
                    formatter: value => {
                        return value ? 'Да' : 'Нет'
                    }
                },
                {
                    name: 'actions',
                    title: '',
                    dataClass: "text-right",
                }
            ]
        }
    },
    methods: {
        showAddPaymentForm() {
            this.$modal.show(
                AddPaymentForm,
                {managers: this.managers},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddPaymentForm'},
                {
                    'paymentAdded': (payment) => {
                        this.data.payment.push(payment)
                    }
                }
            )
        },
        showEditPaymentForm(index) {
            this.$modal.show(
                AddPaymentForm,
                {data: this.data.payment[index], managers: this.managers},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddPaymentForm'},
                {
                    'paymentEdited': (payment) => {
                        this.data.payment.splice(index, 1, payment)
                    }
                }
            )
        },
        async fetchUsers() {
            try {
                const {data} = await axios.get('/api/managers', {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    },
                })
                this.managers = data.data
            } catch (e) {
                this.$notify({
                    text: e,
                    title: 'Ошибка сервера',
                    type: 'error'
                })
            }
        }
    },
    mounted() {
        this.fetchUsers()
    }
}
</script>

<style scoped>

</style>
