<template>
    <div id="income" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Дети</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="button" @click="showAddChildForm">Добавить
            </button>
        </div>
        <template v-if="children.length">
            <div class="mt-4">
                <vuetable
                    ref="children"
                    :api-mode="false"
                    :css="classes.table"
                    :data="children"
                    :fields="fields"
                >
                </vuetable>
            </div>
        </template>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";

export default {
    name: "Children",
    components: {
        Vuetable
    },
    data() {
        return {
            children: [],
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
                    name: 'fio',
                    title: 'ФИО ребенка'
                },
                {
                    name: 'birthday',
                    title: 'Дата рождения'
                },
                {
                    name: 'age',
                    title: 'Возраст'
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
        showAddChildForm() {
            console.log('showAddChildForm')
        }
    }
}
</script>

<style scoped>

</style>
