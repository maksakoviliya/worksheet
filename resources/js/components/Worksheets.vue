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
                       placeholder="Поиск анкет"/>
            </div>
            <!--            <svg v-if="loading" class="animate-spin h-5 w-5 mr-3 fill-current text-gray-500 mr-auto ml-2" viewBox="0 0 512 512">-->
            <!--                <path d="M24 304a24 24 0 1124 24 24 24 0 01-24-24zm168 168a24 24 0 10-24-24 24 24 0 0024 24zm-91-53a24 24 0 10-24-24 24 24 0 0024 24zm115 29a24 24 0 10-24 24 24 24 0 0024-24m-115-29a24 24 0 10-24-24 24 24 0 0024 24zM24 192a24 24 0 1024-24 24 24 0 00-24 24zM168 48a24 24 0 1024-24 24 24 0 00-24 24zm-91 53a24 24 0 1024-24 24 24 0 00-24 24zm-53 91a24 24 0 1024-24 24 24 0 00-24 24zM216 48a24 24 0 10-24 24 24 24 0 0024-24M77 101a24 24 0 1024-24 24 24 0 00-24 24zm228.4-29.922C384.653 93.751 440 166.5 440 248a181.553 181.553 0 01-38.115 111.96 184.289 184.289 0 01-33.1 33.065l-5.669 20.408 49.393 5.488A230.377 230.377 0 00488 248a228.313 228.313 0 00-48.4-140.983 236.543 236.543 0 00-120.993-82.086 24 24 0 00-13.2 46.147zM479.854 466.65a24 24 0 00-21.2-26.5L342.67 427.26l32.454-116.836a24 24 0 10-46.248-12.848l-40 144a24 24 0 0020.474 30.278l144 16a24.512 24.512 0 002.679.148 24.005 24.005 0 0023.825-21.352z"/>-->
            <!--            </svg>-->
            <a href="/worksheets/create"
               class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 ml-3 focus:outline-none focus:shadow">Добавить</a>
        </div>
        <div
            class="align-middle inline-block min-w-full w-full shadow overflow-auto sm:rounded-lg border-b border-gray-200 mt-6">
            <vuetable
                ref="worksheetsVuetable"
                :append-params="{search}"
                :css="classes.table"
                :fields="fields"
                :http-options="httpOptions"
                api-url="/api/worksheets"
                pagination-path="meta"
                @vuetable:pagination-data="onPaginationData"
                @vuetable:row-clicked="onRowClicked"
            >
                <template slot="actions" slot-scope="props">
                    <a :href="`/worksheets/${props.rowData.id}`"
                       class="text-gray-600 hover:text-gray-900 transition duration-200 ease-in-out inline-flex items-center focus:outline-none focus:text-gray-500">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 512.009 512.009">
                            <path
                                d="M397.96 330.099c-13.755 0-24.872 11.118-24.872 24.872v78.125c0 13.73-11.143 24.872-24.872 24.872H74.617c-13.73 0-24.872-11.143-24.872-24.872V109.754c0-13.73 11.143-24.872 24.872-24.872h144.509c13.754 0 24.872-11.118 24.872-24.872s-11.118-24.872-24.872-24.872H74.617C33.478 35.136 0 68.615 0 109.754v323.342c0 41.139 33.478 74.617 74.617 74.617h273.597c41.139 0 74.617-33.453 74.617-74.617v-78.124c.001-13.755-11.117-24.873-24.871-24.873z"/>
                            <path
                                d="M484.193 31.977c-18.057-18.057-41.637-27.161-65.39-27.658-24.997-.547-50.143 8.506-69.046 27.434L181.37 200.14c-24.574 24.674-38.105 57.406-38.105 92.177v55.714c0 13.754 11.118 24.872 24.872 24.872h55.714c34.772 0 67.504-13.531 92.202-38.13L484.216 166.61c37.061-37.083 37.061-97.523-.023-134.633zM280.91 299.581c-15.247 15.197-35.543 23.579-57.057 23.579H193.01v-30.842c0-21.515 8.382-41.811 23.554-57.033L327.57 124.279l64.32 64.32-110.98 110.982zm168.113-168.114L427.06 153.43l-64.32-64.32 21.962-21.962c17.759-17.759 46.611-17.709 64.32 0 17.71 17.733 17.71 46.585.001 64.319z"/>
                        </svg>
                    </a>
                    <button @click.prevent="showDeleteWorksheetForm(props.rowData.id)" type="button"
                            v-if="canDelete"
                            class="delete-btn text-gray-600 hover:text-red-900 transition duration-200 ease-in-out inline-flex items-center focus:outline-none focus:text-gray-500 ml-3"
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
                         ref="pagination"></users-paginator>
    </div>
</template>

<script>
import Vuetable from 'vuetable-2'
import UsersPaginator from './UsersPaginator'
import UsersForm from "./UsersCreateForm";
import DeleteConfirmation from "./DeleteConfirmation";
import axios from "axios";

export default {
    name: "Worksheets",
    components: {
        Vuetable,
        UsersPaginator,
        UsersForm
    },
    props: {
        token: {
            required: true,
            type: String
        },
        canDelete: {
            required: true,
            type: Boolean
        }
        // isAdmin: {
        //     required: true,
        //     type: Boolean
        // },
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
                // {
                //     name: 'id',
                //     title: '##',
                // },
                {
                    name: 'actions',
                    title: '',
                    dataClass: "text-right",
                },
                {
                    name: 'envyID',
                    title: 'ID сделки',
                    formatter: value => _.truncate(value)
                },
                {
                    name: 'name',
                    title: 'Имя клиента'
                },
                {
                    name: 'phone',
                    title: 'Телефон клиента'
                },
                {
                    name: 'user',
                    title: 'Кто добавил',
                    formatter: value => {
                        return value.name
                    }
                },
                {
                    name: 'filial',
                    title: 'Филиал',
                },
                {
                    name: 'credits_total',
                    title: 'Сумма кредитов',
                    formatter: value => {
                        return new Intl.NumberFormat('ru-RU', {
                            style: 'currency',
                            currency: 'RUB',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(_.sumBy(value, c => {
                            return this.$ci.parse(String(c), {
                                currency: "RUB",
                                precision: 0,
                            })
                        }))
                    }
                },
                {
                    name: 'credits_monthly',
                    title: 'Ежемесячный платеж',
                    formatter: value => {
                        return new Intl.NumberFormat('ru-RU', {
                            style: 'currency',
                            currency: 'RUB',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(_.sumBy(value, c => {
                            return this.$ci.parse(String(c), {
                                currency: "RUB",
                                precision: 0,
                            })
                        }))
                    }
                },
                {
                    name: 'created_at',
                    title: 'Дата создания',
                    // formatter: value => moment(value).format('DD.MM.YYYY')
                },
            ]
        }
    },
    watch: {
        search: _.debounce(async function () {
            this.$nextTick(() => {
                this.$refs.worksheetsVuetable.refresh()
            })
        }, 500)
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.worksheetsVuetable.changePage(page)
        },
        onRowClicked(object) {
            if(!object.event.target.closest('.delete-btn')) {
                window.location.href = `/worksheets/${object.data.id}`
            }
        },
        showDeleteWorksheetForm(id) {
            this.$modal.show(
                DeleteConfirmation,
                {
                    data: {
                        type: 'анкету'
                    }
                },
                {classes: 'rounded-lg ml-32', height: 'auto', width: '500px', name: 'DeleteConfirmation'},
                {
                    'onConfirm': () => {
                        this.deleteWorksheet(id)
                    }
                }
            )
        },
        async deleteWorksheet(id) {
            try {
                await axios.delete(`/api/worksheets/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                })
                this.$refs.worksheetsVuetable.reload()
                this.$notify({
                    title: 'Все получилось!',
                    text: 'Анкета удален успешно',
                    type: 'success'
                })
            } catch (e) {
                this.$notify({
                    title: 'Ошибка!',
                    text: 'Анкета не удалена',
                    type: 'error'
                })
            }
        }
    },
}
</script>

<style lang="scss">
.worksheet-table {
    thead {
        tr {
            th {
                @apply px-6 py-3 border-b border-gray-200 bg-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider;
            }
        }
    }

    tbody {
        @apply bg-white;
        tr {
            td {
                @apply px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-600;
            }
        }
    }
}
</style>
