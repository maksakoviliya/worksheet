<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addCreditor)">
            <ValidationProvider v-slot="{ errors }" name="bank" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="bank">Банк<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="bank"
                       v-model="bank"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="type" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="type">Тип кредита<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="type"
                       v-model="type"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="total" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="total">Сумма кредита<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="total"
                       v-model="total"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="current" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="current">Текущая задолженность<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="current"
                       v-model="current"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="monthly" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="monthly">Ежемесячный платеж<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="monthly"
                       v-model="monthly"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="delay" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="delay">Просрочка (мес)<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="delay"
                       v-model="delay"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="comment" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="comment">Комментарий<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <textarea id="comment" v-model="comment"
                          :class="{'border-red-400 focus:red-400': errors.length}"
                          class="appearance-none resize-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                          name="comment"
                          placeholder=""></textarea>
            </ValidationProvider>
            <div class="mt-6">
                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">Добавить
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('AddCreditorForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
export default {
    name: "AddCreditorForm",
    data() {
        return {
            bank: '',
            type: '',
            total: '',
            current: '',
            monthly: '',
            delay: '',
            comment: '',

        }
    },
    methods: {
        addCreditor() {
            this.$parent.$emit('creditorAdded', {
                bank: this.bank,
                type: this.type,
                total: this.total,
                current: this.current,
                monthly: this.monthly,
                delay: this.delay,
                comment: this.comment
            })
            this.$modal.hide('AddCreditorForm')
        }
    }
}
</script>
