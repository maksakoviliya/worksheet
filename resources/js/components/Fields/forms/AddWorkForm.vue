<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addWork)">
            <ValidationProvider v-slot="{ errors }" name="place" rules="max:255" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="place">Место работы: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="place"
                       v-model="place"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="position" rules="max:255" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="position">Должность: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="position"
                       v-model="position"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="legal" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="legal">Официальный доход<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="legal"
                       v-model="legal"
                       v-currency
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="illegal" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="illegal">Неофициальный доход<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="illegal"
                       v-currency
                       v-model="illegal"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <div class="mt-6">
                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">{{ editing ? 'Изменить' : 'Добавить' }}
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('AddWorkForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
export default {
    name: "AddWorkForm",
    props: [
        'data'
    ],
    computed: {
        editing() {
            return !!this.data
        }
    },
    data() {
        return {
            place: this.data?.place || '',
            position: this.data?.position || '',
            legal: this.data?.legal || '0 ₽',
            illegal: this.data?.illegal || '0 ₽',
        }
    },
    methods: {
        addWork() {
            let data = {
                place: this.place,
                position: this.position,
                legal: this.legal,
                illegal: this.illegal,
            }
            if (!this.editing) {
                this.$parent.$emit('workAdded', data)
            } else {
                this.$parent.$emit('workEdited', data)
            }

            this.$modal.hide('AddWorkForm')
        }
    }
}
</script>
