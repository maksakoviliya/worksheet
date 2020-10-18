<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(addChild)">
            <ValidationProvider v-slot="{ errors }" name="name" rules="required" tag="div">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="name">ФИО ребенка<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <input id="name"
                       v-model="name"
                       :class="{'border-red-400 focus:red-400': errors.length}"
                       class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                       placeholder=""/>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="birthday" rules="required" tag="div" class="mt-4">
                <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="child_birthday">Дата рождения<span
                    class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                        errors[0]
                    }}</small>
                </label>
                <date-picker id="child_birthday"
                             v-model="birthday"
                             placeholder="22.08.1987"
                             :input-class="errors.length ? 'custom-input has-errors' : 'custom-input'"
                             format="DD.MM.YYYY"
                             prefix-class="custom"
                             type="date"></date-picker>
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
                    type="button" @click="$modal.hide('AddChildForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>
<script>
import {VueMaskDirective} from 'v-mask'

export default {
    name: "AddChildForm",
    directives: {
        'mask': VueMaskDirective
    },
    data() {
        return {
            name: '',
            birthday: '',
        }
    },
    methods: {
        addChild() {
            this.$parent.$emit('childAdded', {
                name: this.name,
                birthday: this.birthday,
            })
            this.$modal.hide('AddChildForm')
        }
    }
}
</script>
