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
        <template v-if="payment.length">
            <div class="mt-4">
                <vuetable
                    ref="payment"
                    :api-mode="false"
                    :css="classes.table"
                    :data="payment"
                    :fields="fields"
                >
                </vuetable>
            </div>
        </template>
        <div v-else class="mt-4 text-gray-500 font-light">Нет данных</div>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";
import AddPaymentForm from "./forms/AddPaymentForm";

export default {
    name: "Children",
    components: {
        Vuetable
    },
    data() {
        return {
            payment: [],
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
            fields: [
                {
                    name: 'filial',
                    title: 'Филиал'
                },
                {
                    name: 'manager',
                    title: 'Менеджер'
                },
                {
                    name: 'budget',
                    title: 'Бюджет'
                },
                {
                    name: 'monthly',
                    title: 'Ежемесячный платеж'
                },
                {
                    name: 'installment',
                    title: 'Срок рассрочки (мес)'
                },
                {
                    name: 'date',
                    title: 'Дата платежа рассрочки'
                },
                {
                    name: 'online',
                    title: 'Онлайн продажа'
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
                {},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddPaymentForm'},
                {
                    'paymentAdded': (payment) => {
                        this.payment.push(payment)
                    }
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
