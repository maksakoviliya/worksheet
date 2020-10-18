<template>
    <div id="maritalStatus" class="rounded-lg bg-white p-6 mr-6 shadow-md">
        <h3 class="font-semibold text-lg text-gray-600 mr-4">Семейное положение</h3>
        <hr class="w-20 border-teal-400 mt-2">

        <div class="mt-4">
            <label class="inline-flex items-center cursor-pointer" for="isMarried">
                    <span class="relative">
                      <span class="block w-10 h-6 bg-gray-400 rounded-full shadow-inner"></span>
                        <span
                            :class="data.isMarried ? 'bg-teal-500 transform translate-x-full' : 'bg-white'"
                            class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                        <input id="isMarried" v-model="data.isMarried" class="absolute opacity-0 w-0 h-0"
                               type="checkbox"/>
                      </span>
                    </span>
                <span class="ml-3 text-sm text-gray-800 inline-flex flex-col">Семейное положение <span
                    class="text-gray-500">({{
                        data.isMarried ? 'Женат/Замужем' : 'Холост'
                    }})</span></span>
            </label>
        </div>
        <transition name="slide-y">
            <VueSlideToggle :duration="200" :open="data.isMarried" tag="div">
                <ValidationObserver ref="maritalValidationObserver" v-if="data.isMarried" v-slot="{ invalid, handleSubmit }" tag="div">
                    <ValidationProvider v-slot="{ errors }" :class="data.isMarried ? 'opcity-1' : 'opacity-0'"
                                        class="mt-4" name="spouse" rules="required|max:255"
                                        tag="div">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="spouse">ФИО супруга(и) в
                            тварительном
                            падеже<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small>
                        </label>
                        <input id="spouse" v-model="data.spouse"
                               :class="{'border-red-400 focus:red-400': errors.length}"
                               class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                               name="issuedBy"
                               placeholder="Петровой Оксане Валентиновне">
                    </ValidationProvider>
                </ValidationObserver>
            </VueSlideToggle>
        </transition>
    </div>
</template>

<script>
import {VueSlideToggle} from "vue-slide-toggle";

export default {
    name: "MaritalStatus",
    components: {
        VueSlideToggle
    },
    props: ['data'],
}
</script>

<style scoped>

</style>
