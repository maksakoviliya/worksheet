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
        <template v-if="data.children.length">
            <div class="mt-4">
                <vuetable
                    ref="children"
                    :api-mode="false"
                    :css="classes.table"
                    :data="childrenComputed"
                    :fields="fields"
                >
                    <div slot="actions" slot-scope="props">
                        <button @click="data.children.splice(props.rowIndex, 1)"
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
import moment from "moment";
import AddChildForm from "./forms/AddChildForm";

export default {
    name: "Children",
    components: {
        Vuetable
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
            fields: [
                {
                    name: 'name',
                    title: 'ФИО ребенка'
                },
                {
                    name: 'birthday',
                    title: 'Дата рождения',
                    formatter: value=>{
                        return moment(value).format('DD.MM.YYYY')
                    }
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
            return this.data.children.map(child => {
                child['age'] = moment().diff(moment(child.birthday), 'years')
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
                        this.data.children.push(child)
                    }
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
