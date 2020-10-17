<template>
    <div id="income" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Движимое имущество супруга(и)</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="button" @click="showAddMovableForm">Добавить
            </button>
        </div>
        <template v-if="movable.length">
            <div class="mt-4">
                <vuetable
                    ref="movable"
                    :api-mode="false"
                    :css="classes.table"
                    :data="movable"
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
import AddImmovableForm from "./forms/AddImmovableForm";
import AddMovableForm from "./forms/AddMovableForm";

export default {
    name: "Children",
    components: {
        Vuetable
    },
    data() {
        return {
            movable: [],
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
                    name: 'type',
                    title: 'Вид имущества'
                },
                {
                    name: 'ownership',
                    title: 'Вид собственности'
                },
                {
                    name: 'address',
                    title: 'Местонахождение'
                },
                {
                    name: 'model',
                    title: 'Марка и модель'
                },
                {
                    name: 'vin',
                    title: 'VIN номер'
                },
                {
                    name: 'pledge',
                    title: 'Сведения о залоге'
                },
                {
                    name: 'cost',
                    title: 'Стоимость'
                },
                {
                    name: 'date',
                    title: 'Дата приобретения'
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
        showAddMovableForm() {
            this.$modal.show(
                AddMovableForm,
                {},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddMovableForm'},
                {
                    'movableAdded': (movable) => {
                        this.movable.push(movable)
                    }
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
