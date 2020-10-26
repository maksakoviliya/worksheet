<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addVoidableImmovable)">
            <ValidationProvider v-slot="{ errors }" name="object" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="objectImmovable">Объект<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="objectImmovable"
                       v-model="object"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="date" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="dateImmovable">Дата оспоримой сделки<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <date-picker id="dateImmovable"
                             v-model="dateComputed"
                             placeholder="22.08.1987"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             prefix-class="custom"
                             type="date"></date-picker>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="cost" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="costImmovable">Стоимость<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="costImmovable"
                       v-model="cost"
                       v-currency
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" class="mt-4" name="money" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="moneyImmovable">Куда потрачены деньги<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="moneyImmovable"
                       v-model="money"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="buyDate" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="buyDate">Дата приобретения<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <date-picker id="buyDate"
                             v-model="buyDateComputed"
                             placeholder="22.08.1987"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             prefix-class="custom"
                             type="date"></date-picker>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="basis" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="basis">Основание приобретения<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="basis"
                       v-model="basis"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="registrationDate" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="registrationDate">Дата оформления
                    права собственности<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                </label>
                <date-picker id="registrationDate"
                             v-model="registrationDateComputed"
                             placeholder="22.08.1987"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             prefix-class="custom"
                             type="date"></date-picker>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="source" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="source">На какие денежные средства
                    приобретался объект<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                </label>
                <multiselect id="source"
                             v-model="source"
                             :class="{'invalid': errors.length}"
                             :options="sourceOptions.map(option=>option.id)"
                             :custom-label="value=>sourceOptions.find(option=>option.id===value).label"
                             :show-labels="false"
                             placeholder="Выберите один из вариантов"></multiselect>
            </ValidationProvider>
            <transition name="slide-y">
                <!-- Если в кредит -->
                <VueSlideToggle :duration="200" :open="source===1" tag="div">
                    <ValidationProvider v-slot="{ errors }" name="creditFinishDate" rules="required_if" v-if="source===1" tag="div"
                                        class="mt-4">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="creditFinishDate">Дата
                            закрытия кредита<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <date-picker id="creditFinishDate"
                                     v-model="creditFinishDateComputed"
                                     placeholder="22.08.1987"
                                     :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                                     format="DD.MM.YYYY"
                                     prefix-class="custom"
                                     type="date"></date-picker>
                    </ValidationProvider>
                </VueSlideToggle>
            </transition>
            <!--            <ValidationProvider v-slot="{ errors }" name="ptsDate" rules="required" tag="div" class="mt-4">-->
            <!--                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="ptsDate">Дата акта приема-передачи-->
            <!--                    ПТС между банком и клиентом<span-->
            <!--                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{-->
            <!--                            errors[0]-->
            <!--                        }}</small>-->
            <!--                </label>-->
            <!--                <date-picker id="ptsDate"-->
            <!--                             v-model="ptsDateComputed"-->
            <!--                             placeholder="22.08.1987"-->
            <!--                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"-->
            <!--                             format="DD.MM.YYYY"-->
            <!--                             prefix-class="custom"-->
            <!--                             type="date"></date-picker>-->
            <!--            </ValidationProvider>-->
            <div class="mt-4">
                <label class="inline-flex items-center cursor-pointer" for="creditorsImmovable">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="creditors ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="creditorsImmovable" v-model="creditors" class="absolute opacity-0 w-0 h-0"
                               type="checkbox"/>
                      </span>
                    </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Имелись ли у клиента задолженности перед кредиторами на момент приобретения недвижимости (оформленные кредиты)?<span
                        class="text-gray-500">({{
                            creditors ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
            <transition name="slide-y">
                <!-- Если в кредит -->
                <VueSlideToggle :duration="200" :open="creditors===true" tag="div">
                    <ValidationProvider v-slot="{ errors }" name="delayDate" rules="required" v-if="creditors===true" tag="div" class="mt-4">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="delayDate">Когда
                            образовались просрочки по кредитам?<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <date-picker id="delayDate"
                                     v-model="delayDateComputed"
                                     placeholder="22.08.1987"
                                     :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                                     format="DD.MM.YYYY"
                                     prefix-class="custom"
                                     type="date"></date-picker>
                    </ValidationProvider>
                </VueSlideToggle>
            </transition>
            <div class="mt-4">
                <label class="inline-flex items-center cursor-pointer" for="wasMarried">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="wasMarried ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="wasMarried" v-model="wasMarried" class="absolute opacity-0 w-0 h-0"
                               type="checkbox"/>
                      </span>
                    </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Находился ли в зарегистрированном браке клиент, когда приобретал недвижимость?<span
                        class="text-gray-500">({{
                            wasMarried ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
            <transition name="slide-y">
                <!-- Если в браке -->
                <VueSlideToggle :duration="200" :open="wasMarried===true" tag="div">
                    <ValidationProvider v-slot="{ errors }" name="delayDate" rules="" tag="div" class="mt-4">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="divorceDate">Если
                            приобретал в браке, а потом развелся, то дата расторжения брака: <small v-if="errors[0]"
                                                                                                    class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <date-picker id="divorceDate"
                                     v-model="divorceDateComputed"
                                     placeholder="22.08.1987"
                                     :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                                     format="DD.MM.YYYY"
                                     prefix-class="custom"
                                     type="date"></date-picker>
                    </ValidationProvider>
                    <div class="mt-4">
                        <label class="inline-flex items-center cursor-pointer" for="contract">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="contract ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="contract" v-model="contract" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                            <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Имеется ли брачный договор (соглашение)?<span
                                class="text-gray-500">({{
                                    contract ? 'Да' : 'Нет'
                                }})</span></span>
                        </label>
                    </div>
                    <ValidationProvider v-slot="{ errors }" name="whoPaied" rules="required" tag="div" class="mt-4"
                                        v-if="source === 1 && wasMarried===true">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="whoPaied">Если брали
                            недвижимость
                            в кредит, то кто оплачивал платежи по кредиту?<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <input id="whoPaied"
                               v-model="whoPaied"
                               :class="{'border-red-400 focus:red-400': errors.length}"
                               class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                               placeholder=""/>
                    </ValidationProvider>
                    <div class="mt-4">
                        <label class="inline-flex items-center cursor-pointer" for="borrowers">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="borrowers ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="borrowers" v-model="borrowers" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                            <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Являются ли супруги созаемщиками?<span
                                class="text-gray-500">({{
                                    borrowers ? 'Да' : 'Нет'
                                }})</span></span>
                        </label>
                    </div>
                    <ValidationProvider v-slot="{ errors }" name="share" rules="required" tag="div" v-if="wasMarried===true" class="mt-4">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="share">Определены ли доли
                            в праве собственности их и детей, если есть, 1/2, 1/3 и т.д. Либо совместная собственность,
                            без определения долей?<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <input id="share"
                               v-model="share"
                               :class="{'border-red-400 focus:red-400': errors.length}"
                               class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                               placeholder=""/>
                    </ValidationProvider>
                    <transition name="slide-y">
                        <!-- Если в браке -->
                        <VueSlideToggle :duration="200" :open="borrowers===false" tag="div">
                            <div class="mt-4">
                                <label class="inline-flex items-center cursor-pointer" for="guarantor">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="guarantor ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="guarantor" v-model="guarantor" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Является ли кто-либо из супругов поручителем?<span
                                        class="text-gray-500">({{
                                            guarantor ? 'Да' : 'Нет'
                                        }})</span></span>
                                </label>
                            </div>
                        </VueSlideToggle>
                    </transition>
                </VueSlideToggle>
            </transition>
            <div class="mt-4">
                <label class="inline-flex items-center cursor-pointer" for="processes">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="processes ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="processes" v-model="processes" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Имелись ли исполнительные производства на момент приобретения недвижимости?<span
                        class="text-gray-500">({{
                            processes ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
            <transition name="slide-y">
                <!-- Если есть исполнительные производства -->
                <VueSlideToggle :duration="200" :open="processes===true" tag="div">
                    <div class="mt-4">
                        <label class="inline-flex items-center cursor-pointer" for="ban">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="ban ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="ban" v-model="ban" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                            <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Есть ли по этим исполнительным производствам Постановления о запрете на совершение регистрационных действий с недвижимости?<span
                                class="text-gray-500">({{
                                    ban ? 'Да' : 'Нет'
                                }})</span></span>
                        </label>
                    </div>
                </VueSlideToggle>
            </transition>
            <div class="mt-4">
                <label class="inline-flex items-center cursor-pointer" for="propiska">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="propiska ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="propiska" v-model="propiska" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Зарегистрированы ли клиенты (прописка) в указанных объектах? <span
                        class="text-gray-500">({{
                            propiska ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
            <ValidationProvider v-slot="{ errors }" name="bills" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="bills">Имеется ли задолженность по квартплате?<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="bills"
                       v-model="bills"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <div class="mt-4">
                <label class="inline-flex items-center cursor-pointer" for="payByMatency">
                        <span class="relative">
                          <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                            <span
                                :class="payByMatency ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input id="payByMatency" v-model="payByMatency" class="absolute opacity-0 w-0 h-0"
                                   type="checkbox"/>
                          </span>
                        </span>
                    <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Имеется ли факт оплаты ипотеки материнским капиталом? <span
                        class="text-gray-500">({{
                            payByMatency ? 'Да' : 'Нет'
                        }})</span></span>
                </label>
            </div>
            <div class="mt-6">
                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">{{ editing ? 'Изменить' : 'Добавить' }}
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('AddVoidableMovableForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>

<script>
import moment from "moment";
import {VueSlideToggle} from "vue-slide-toggle";

export default {
    name: "AddVoidableMovableForm",
    components: {
        VueSlideToggle
    },
    props: [
        'data'
    ],
    data() {
        return {
            object: this.data?.object || '',
            date: this.data?.date || '',
            cost: this.data?.cost || '',
            money: this.data?.money || '',
            buyDate: this.data?.buyDate || '',
            basis: this.data?.basis || '',
            registrationDate: this.data?.registrationDate || '',
            source: this.data?.source || '',
            creditFinishDate: this.data?.creditFinishDate || '',
            // ptsDate: this.data?.ptsDate || '',
            creditors: this.data?.creditors || false,
            delayDate: this.data?.delayDate || '',
            wasMarried: this.data?.wasMarried || false,
            divorceDate: this.data?.divorceDate || '',
            contract: this.data?.contract || false,
            whoPaied: this.data?.whoPaied || '',
            processes: this.data?.processes || false,
            ban: this.data?.ban || false,
            removal: this.data?.removal || false,
            borrowers: this.data?.borrowers || false,
            share: this.data?.share || '',
            guarantor: this.data?.guarantor || false,
            propiska: this.data?.propiska || false,
            bills: this.data?.bills || '',
            payByMatency: this.data?.payByMatency || false,
            sourceOptions: [
                {
                    id: 1,
                    label: 'Кредит (Ипотека)',
                    slug: 'credit'
                },
                {
                    id: 2,
                    label: 'Собственные сбережения',
                    slug: 'own'
                },
                {
                    id: 3,
                    label: 'Трейд–ИН',
                    slug: 'trade-in'
                },
                {
                    id: 4,
                    label: 'Займ у родственников',
                    slug: 'loan'
                },
                {
                    id: 5,
                    label: 'Материнский капитал',
                    slug: 'maternal'
                },
            ]
        }
    },
    computed: {
        editing() {
            return !!this.data
        },
        dateComputed: {
            get: function () {
                if (this.date) {
                    return moment(this.date).toDate()
                }
            },
            set: function (value) {
                this.date = value
            }
        },
        buyDateComputed: {
            get: function () {
                if (this.buyDate) {
                    return moment(this.buyDate).toDate()
                }
            },
            set: function (value) {
                this.buyDate = value
            }
        },
        registrationDateComputed: {
            get: function () {
                if (this.registrationDate) {
                    return moment(this.registrationDate).toDate()
                }
            },
            set: function (value) {
                this.registrationDate = value
            }
        },
        creditFinishDateComputed: {
            get: function () {
                if (this.creditFinishDate) {
                    return moment(this.creditFinishDate).toDate()
                }
            },
            set: function (value) {
                this.creditFinishDate = value
            }
        },
        // ptsDateComputed: {
        //     get: function () {
        //         if (this.ptsDate) {
        //             return moment(this.ptsDate).toDate()
        //         }
        //     },
        //     set: function (value) {
        //         this.ptsDate = value
        //     }
        // },
        delayDateComputed: {
            get: function () {
                if (this.delayDate) {
                    return moment(this.delayDate).toDate()
                }
            },
            set: function (value) {
                this.delayDate = value
            }
        },
        divorceDateComputed: {
            get: function () {
                if (this.divorceDate) {
                    return moment(this.divorceDate).toDate()
                }
            },
            set: function (value) {
                this.divorceDate = value
            }
        },
    },
    methods: {
        addVoidableImmovable() {
            let data = {
                object: this.object,
                date: this.date,
                cost: this.cost,
                money: this.money,
                buyDate: this.buyDate,
                basis: this.basis,
                registrationDate: this.registrationDate,
                source: this.source,
                creditFinishDate: this.creditFinishDate,
                creditors: this.creditors,
                delayDate: this.delayDate,
                wasMarried: this.wasMarried,
                divorceDate: this.divorceDate,
                contract: this.contract,
                whoPaied: this.whoPaied,
                processes: this.processes,
                ban: this.ban,
                removal: this.removal,
                borrowers: this.borrowers,
                share: this.share,
                guarantor: this.guarantor,
                propiska: this.propiska,
                bills: this.bills,
                payByMatency: this.payByMatency,
            }
            if (!this.editing) {
                this.$parent.$emit('voidableImmovableAdded', data)
            } else {
                this.$parent.$emit('voidableImmovableEdited', data)
            }

            this.$modal.hide('AddVoidableImmovableForm')
        }
    }
}
</script>

<style scoped>

</style>
