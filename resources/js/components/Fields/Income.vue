<template>
    <div id="income" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg text-gray-600 mr-4">Официальный доход</h3>
                <hr class="w-20 border-teal-400 mt-2">
            </div>
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="button" @click="showAddWorkForm">Добавить
            </button>
        </div>
        <template v-if="sources.length">
            <div class="mt-4">
                <vuetable
                    ref="creditors"
                    :api-mode="false"
                    :css="classes.table"
                    :data="sources"
                    :fields="fields"
                >
                </vuetable>
            </div>
            <h3 class="font-semibold text-gray-600 mt-4">Итоги по доходам</h3>
            <hr class="w-20 border-gray-400 mt-2">
            <p class="text-gray-800 mt-1 text-sm">Общая сумма официальных доходов: <span
                class="text-gray-500 font-semibold text-base">23234</span></p>
            <p class="text-gray-800 mt-1 text-sm">Общая сумма неофициальных доходов: <span
                class="text-gray-500 font-semibold text-base">23234</span></p>
            <p class="text-gray-800 mt-4 text-sm">Общая сумма доходов: <span
                class="text-gray-500 font-semibold text-base">234234</span></p>
        </template>
        <div v-else class="mt-4 text-gray-500 font-light">Нет данных</div>
        <h3 class="font-semibold text-gray-600 mt-4">Предпренимательская деятельность</h3>
        <hr class="w-20 border-gray-400 mt-2">
        <div class="flex">
            <div class="w-1/2">
                <label class="mt-3 inline-flex items-center cursor-pointer" for="isIp">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="isIp ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="isIp" v-model="isIp" class="absolute opacity-0 w-0 h-0" type="checkbox"/>
                      </span>
                    </span>
                    <span class="ml-3 text-sm text-gray-800">Являетсь ли вы учредителем ООО/ИП? <span class="text-gray-500">({{
                            isIp ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
                <transition name="slide-y">
                    <VueSlideToggle :duration="200" :open="isIp" tag="div">
                        <ValidationProvider v-slot="{ errors }" class="mt-4" name="oooComment"
                                            rules="required|max:255" tag="div">
                            <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="oooComment">Комментарий<span
                                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                        errors[0]
                                    }}</small>
                            </label>
                            <textarea id="oooComment" v-model="oooComment"
                                      :class="{'border-red-400 focus:red-400': errors.length}"
                                      class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                                      name="issuedBy"
                                      placeholder=""></textarea>
                        </ValidationProvider>
                    </VueSlideToggle>
                </transition>
            </div>
            <div class="w-1/2">
                <label class="mt-3 inline-flex items-center cursor-pointer" for="isDirector">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="isDirector ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="isDirector" v-model="isDirector" class="absolute opacity-0 w-0 h-0" type="checkbox"/>
                      </span>
                    </span>
                    <span class="ml-3 text-sm text-gray-800">Являетесь ли Вы генеральным директором в ООО? <span class="text-gray-500">({{
                            isDirector ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";
import {VueSlideToggle} from "vue-slide-toggle";
import AddWorkForm from "./forms/AddWorkForm";

export default {
    name: 'Income',
    components: {
        Vuetable,
        VueSlideToggle
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
            sources: [],
            isIp: false,
            isDirector: false,
            oooComment: '',
            fields: [
                {
                    name: 'place',
                    title: 'Место работы'
                },
                {
                    name: 'position',
                    title: 'Должность'
                },
                {
                    name: 'legal',
                    title: 'Официальный доход'
                },
                {
                    name: 'illegal',
                    title: 'Неофициальный доход'
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
        showAddWorkForm() {
            this.$modal.show(
                AddWorkForm,
                {},
                {classes: 'rounded-lg ml-32', height: 'auto', name: 'AddWorkForm'},
                {
                    'workAdded': (creditor) => {
                        this.sources.push(creditor)
                    }
                }
            )
        }
    }
}
</script>
