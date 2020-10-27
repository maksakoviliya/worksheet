<template>
    <div>
        <notifications/>
        <div class="flex justify-between items-center">
            <div class="block relative mt-0">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="h-4 w-4 fill-current text-gray-500" viewBox="0 0 513.28 513.28">
                            <path
                                d="M495.04 404.48L410.56 320c15.36-30.72 25.6-66.56 25.6-102.4C436.16 97.28 338.88 0 218.56 0S.96 97.28.96 217.6s97.28 217.6 217.6 217.6c35.84 0 71.68-10.24 102.4-25.6l84.48 84.48c25.6 25.6 64 25.6 89.6 0 23.04-25.6 23.04-64 0-89.6zM218.56 384c-92.16 0-166.4-74.24-166.4-166.4S126.4 51.2 218.56 51.2s166.4 74.24 166.4 166.4S310.72 384 218.56 384z"/>
                        </svg>
                    </span>

                <input v-model="search"
                       class="appearance-none rounded-lg border border-gray-300 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder="Поиск банков"/>
            </div>
        </div>
        <div
            class="align-middle inline-block min-w-full w-full shadow overflow-auto sm:rounded-lg border-b border-gray-200 mt-6">
            <vuetable
                ref="banksVuetable"
                :append-params="{search}"
                :css="classes.table"
                :fields="fields"
                :http-options="httpOptions"
                api-url="/api/banks"
                pagination-path="meta"
                @vuetable:pagination-data="onPaginationData"
            >
                <template slot="actions" slot-scope="props">
                    <button @click="showDeleteBankForm(props.rowData.id)" type="button"
                            class="text-gray-600 hover:text-red-900 transition duration-200 ease-in-out inline-flex items-center focus:outline-none focus:text-gray-500 ml-3"
                    >
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 512.009 512.009">
                            <path
                                d="M300 0h-88c-24.262 0-44 19.738-44 44v36h-56c-35.29 0-64 28.71-64 64 0 32.579 24.475 59.531 56 63.482V448c0 35.29 28.71 64 64 64h176c35.29 0 64-28.71 64-64V207.482c31.525-3.952 56-30.903 56-63.482 0-35.29-28.71-64-64-64h-56V44c0-24.262-19.738-44-44-44zm-84 48h80v32h-80zm144 400c0 8.822-7.178 16-16 16H168c-8.822 0-16-7.178-16-16V208h208zm56-304c0 8.822-7.178 16-16 16H112c-8.822 0-16-7.178-16-16s7.178-16 16-16h288c8.822 0 16 7.178 16 16z"/>
                            <path
                                d="M208 400c13.255 0 24-10.745 24-24v-96c0-13.255-10.745-24-24-24s-24 10.745-24 24v96c0 13.255 10.745 24 24 24zM304 400c13.255 0 24-10.745 24-24v-96c0-13.255-10.745-24-24-24s-24 10.745-24 24v96c0 13.255 10.745 24 24 24z"/>
                        </svg>
                    </button>
                </template>
            </vuetable>
        </div>
        <users-paginator @vuetable-pagination:change-page="onChangePage" class="mt-6"
                         ref="banksPagination"></users-paginator>
    </div>
</template>

<script>
import Vuetable from 'vuetable-2'
import UsersPaginator from "../UsersPaginator";
import DeleteConfirmation from "../DeleteConfirmation";
import axios from "axios";

export default {
    name: "Banks",
    components: {
        Vuetable,
        UsersPaginator
    },
    props: {
        token: {
            required: true
        }
    },
    data() {
        return {
            search: '',
            loading: false,
            classes: {
                table: {
                    tableWrapper: '',
                    tableHeaderClass: 'table-header',
                    tableBodyClass: 'min-w-full worksheet-table',
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
            httpOptions: {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            },
            fields: [
                {
                    name: 'id',
                    title: '##'
                },
                {
                    name: 'name',
                    title: 'Название'
                },
                {
                    name: 'actions',
                    title: '',
                    dataClass: "text-right",
                }
            ]
        }
    },
    watch: {
        search: _.debounce(async function () {
            this.$nextTick(() => {
                this.$refs.banksVuetable.refresh()
            })
        }, 500)
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.banksPagination.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.banksVuetable.changePage(page)
        },
        showDeleteBankForm(id) {
            this.$modal.show(
                DeleteConfirmation,
                {
                    data: {
                        type: 'банк'
                    }
                },
                {classes: 'rounded-lg ml-32', height: 'auto', width: '500px', name: 'DeleteConfirmation'},
                {
                    'onConfirm': () => {
                        this.deleteBank(id)
                    }
                }
            )
        },
        async deleteBank(id) {
            try {
                await axios.delete(`/api/banks/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                })
                this.$refs.banksVuetable.reload()
                this.$notify({
                    title: 'Все получилось!',
                    text: 'Банк удален успешно',
                    type: 'success'
                })
            } catch (e) {
                this.$notify({
                    title: 'Ошибка!',
                    text: 'Банк не удален',
                    type: 'error'
                })
            }
        }
    },
    mounted() {
        this.$root.$on('uploadBanks', () => {
            this.$refs.banksVuetable.reload()
        })
    }
}
</script>

<style scoped>

</style>
