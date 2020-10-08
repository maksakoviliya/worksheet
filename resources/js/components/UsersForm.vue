<template>
    <form action="#" @submit.prevent="addUser">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Имя:</label>
            <input id="username"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="Александр Петров"/>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
            <input id="email"
                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                   placeholder="email@email.ru"/>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="roles">Роль:</label>
            <multiselect id="roles" v-model="role" :options="roles" openDirection="top" :show-labels="false"
                         placeholder="Выберите роль"></multiselect>
        </div>
        <transition name="slide-y">
            <VueSlideToggle :duration="200" :open="showFilials" class="mt-4" tag="div">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="filial">Филиал:</label>
                <multiselect id="filial" v-model="filial" :options="filials" :show-labels="false"
                             placeholder="Выберите филиал"></multiselect>
            </VueSlideToggle>
        </transition>
        <div class="mt-6">
            <button
                class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                type="submit">Добавить
            </button>
            <button
                class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                type="button" @click="showFilials = !showFilials">Отменить
            </button>
        </div>
    </form>
</template>

<script>
import {VueSlideToggle} from 'vue-slide-toggle'

export default {
    name: "UsersForm",
    components: {
        VueSlideToggle
    },
    data() {
        return {
            role: null,
            filial: null,
            showFilials: false,
            roles: ['admin', 'head', 'user'],
            filials: ['Йошкар-Ола', 'Казань', 'Нижний Новгород', 'Чебоксары'],
        }
    },
    methods: {
        addUser() {
            console.log('add user')
        }
    }
}
</script>

<style sxoped>
.slide-y-enter-active, .slide-y-leave-active {
    transition: all .2s ease-in-out;
    max-height: 0;
}

.slide-y-enter, .slide-y-leave-to {
    max-height: 800px;
}
</style>
