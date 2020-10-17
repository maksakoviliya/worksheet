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
                    :data="childrenComputed"
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
import moment from "moment";
import AddChildForm from "./forms/AddChildForm";

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
                    name: 'name',
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
    computed: {
        childrenComputed() {
            return this.children.map(child => {
                child['age'] = moment().diff(child.birthday, 'years')
                return child
            })
        }
    },
    methods: {
        showAddChildForm() {
            this.$modal.show(
                AddChildForm,
                {},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddChildForm'},
                {
                    'childAdded': (child) => {
                        this.children.push(child)
                    }
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
