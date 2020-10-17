<template>
    <div id="creditors" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Кредиторы</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow" type="button" @click="showAddCreditorForm">Добавить</button>
        </div>
        <template v-if="creditors.length">
            <div class="mt-4">
                <vuetable
                    ref="creditors"
                    :api-mode="false"
                    :css="classes.table"
                    :data="creditors"
                    :fields="fields"
                >
                </vuetable>
            </div>
            <h3 class="font-semibold text-gray-600 mt-4">Итоги по кредитам</h3>
            <hr class="w-20 border-gray-400 mt-2">
            <p class="text-gray-800 mt-4 text-sm">Общая сумма кредитов: <span class="text-gray-500 font-semibold text-base">234234</span></p>
            <p class="text-gray-800 mt-1 text-sm">Ежемесячный платеж по всем кредитам: <span class="text-gray-500 font-semibold text-base">23234</span></p>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="nextPayment" rules="required|max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="nextPayment">Дата ближайшего платежа по кредиту<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="nextPayment"
                       v-model="nextPayment"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none w-1/3 rounded-lg border border-gray-300 border-b block px-2 py-2 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder="22.08.1987"/>
            </ValidationProvider>
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
            creditors: [],
            nextPayment: '',
            fields: [
                {
                    name: 'bank',
                    title: 'Банк'
                },
                {
                    name: 'type',
                    title: 'Тип кредита'
                },
                {
                    name: 'total',
                    title: 'Сумма кредита'
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
    methods: {
        showAddCreditorForm() {
            this.$modal.show(
                AddCreditorForm,
                {},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddCreditorForm'},
                {'creditorAdded': (creditor) => {
                        console.log('creditor:', creditor)
                    this.creditors.push(creditor)
                }}
            )
        }
    }
}
</script>
