<template>
    <ValidationObserver ref="ValidationObserver" v-slot="{ invalid, handleSubmit }">
        <form @submit.prevent="handleSubmit(editUser)">
            <div>
                <ValidationProvider v-slot="{ errors }" name="username" rules="required">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="username">Имя<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small>
                    </label>
                    <input id="username"
                           v-model="user.name"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="Александр Петров"/>
                </ValidationProvider>
            </div>
            <div class="mt-4">
                <ValidationProvider v-slot="{ errors }" name="email" rules="required|email">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="email">Email<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small></label>
                    <input id="email"
                           v-model="user.email"
                           :class="{'border-red-400 focus:red-400': errors.length}"
                           class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                           placeholder="email@email.ru"/>
                </ValidationProvider>
            </div>
            <div class="mt-4">
                <ValidationProvider v-slot="{ errors }" name="password" rules="min:3">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="password">Пароль<span
                        class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                            errors[0]
                        }}</small></label>
                    <div class="input-container relative">
                        <input id="password"
                               v-model="user.password"
                               :class="{'border-red-400 focus:red-400': errors.length}"
                               :type="showPasswords ? 'text' : 'password'"
                               class="appearance-none rounded-lg border border-gray-300 border-b block pl-2 pr-8 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                               placeholder="Минимум 3 символа"/>
                        <button
                            class="absolute inset-y-0 right-0 mr-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                            type="button"
                            @click="showPasswords = !showPasswords">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 932.15 932.15">
                                <path
                                    d="M466.075 161.525c-205.6 0-382.8 121.2-464.2 296.1-2.5 5.3-2.5 11.5 0 16.9 81.4 174.899 258.601 296.1 464.2 296.1s382.8-121.2 464.2-296.1c2.5-5.3 2.5-11.5 0-16.9-81.4-174.9-258.6-296.1-464.2-296.1zm0 514.701c-116.1 0-210.1-94.101-210.1-210.101 0-116.1 94.1-210.1 210.1-210.1 116.1 0 210.1 94.1 210.1 210.1s-94.1 210.101-210.1 210.101z"/>
                                <circle cx="466.075" cy="466.025" r="134.5"/>
                            </svg>
                        </button>
                    </div>
                </ValidationProvider>
            </div>
            <transition name="slide-y">
                <VueSlideToggle :duration="200" :open="user.password.length > 0" tag="div">
                    <ValidationProvider v-slot="{ errors }" name="password_confirmation"
                                        rules="confirmed:password">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2 mt-4"
                               for="password_confirmation">Подтвердите
                            пароль<span class="text-red-300 text-sm">*</span>: <small v-if="errors[0]"
                                                                                      class="text-red-400">{{
                                    errors[0]
                                }}</small></label>
                        <div class="input-container relative">
                            <input id="password_confirmation"
                                   v-model="user.password_confirmation"
                                   :class="{'border-red-400 focus:red-400': errors.length}"
                                   :type="showPasswords ? 'text' : 'password'"
                                   class="appearance-none rounded-lg border border-gray-300 border-b block px-2 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-gray-800"
                                   placeholder="Минимум 3 символа"/>
                            <button
                                class="absolute inset-y-0 right-0 mr-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                type="button"
                                @click="showPasswords = !showPasswords">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 932.15 932.15">
                                    <path
                                        d="M466.075 161.525c-205.6 0-382.8 121.2-464.2 296.1-2.5 5.3-2.5 11.5 0 16.9 81.4 174.899 258.601 296.1 464.2 296.1s382.8-121.2 464.2-296.1c2.5-5.3 2.5-11.5 0-16.9-81.4-174.9-258.6-296.1-464.2-296.1zm0 514.701c-116.1 0-210.1-94.101-210.1-210.101 0-116.1 94.1-210.1 210.1-210.1 116.1 0 210.1 94.1 210.1 210.1s-94.1 210.101-210.1 210.101z"/>
                                    <circle cx="466.075" cy="466.025" r="134.5"/>
                                </svg>
                            </button>
                        </div>
                    </ValidationProvider>
                </VueSlideToggle>
            </transition>
            <template v-if="isAdmin">
                <div class="mt-4">
                    <ValidationProvider v-slot="{ errors }" name="role" rules="required">
                        <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="roles">Роль<span
                            class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                errors[0]
                            }}</small></label>
                        <multiselect id="roles" v-model="user.role"
                                     :class="{'invalid': errors.length}"
                                     :custom-label=" opt => roles.find(role => role.name === opt).title"
                                     :options="roles.map(role => role.name)"
                                     :show-labels="false"
                                     placeholder="Выберите роль"></multiselect>
                    </ValidationProvider>
                </div>
                <transition name="slide-y">
                    <VueSlideToggle :duration="200"
                                    :open="(user.role && roles.find(role => role.name === user.role).name !== 'admin')"
                                    tag="div">
                        <ValidationProvider v-slot="{ errors }" name="filial" rules="required_if:role,2,3">
                            <label class="inline-block text-gray-700 text-sm font-bold mb-2 mt-4"
                                   for="filial">Филиал<span
                                class="text-red-300 text-sm">*</span>: <small v-if="errors[0]" class="text-red-400">{{
                                    errors[0]
                                }}</small></label>
                            <multiselect id="filial" v-model="user.filial" :class="{'invalid': errors.length}"
                                         :custom-label=" opt => filials.find(filial => filial.id === opt).name"
                                         :options="filials.map(filial => filial.id)"
                                         :show-labels="false"
                                         placeholder="Выберите филиал"></multiselect>
                        </ValidationProvider>
                    </VueSlideToggle>
                </transition>
            </template>
            <div class="mt-6">

                <button
                    :class="{'opacity-50 cursor-not-allowed': invalid}"
                    :disabled="invalid"
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="submit">Изменить
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button" @click="$modal.hide('UsersEditForm')">Отменить
                </button>
            </div>
        </form>
    </ValidationObserver>
</template>

<script>
import {VueSlideToggle} from 'vue-slide-toggle'
import axios from 'axios'

export default {
    name: "UsersEditForm",
    components: {
        VueSlideToggle
    },
    props: {
        userId: {
            required: true,
            type: Number, String
        },
        token: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            userInitial: {
                name: '',
                email: '',
                role: null,
                filial: null,
                password: '',
                password_confirmation: ''
            },
            user: {
                name: '',
                email: '',
                role: null,
                filial: null,
                password: '',
                password_confirmation: ''
            },
            showFilials: false,
            showPasswords: false,
            roles: [],
            filials: [],
        }
    },
    watch: {
        'user.role': function () {
            this.$refs.ValidationObserver.validate
        }
    },
    methods: {
        async editUser() {
            try {
                await axios.put(`/api/users/${this.userId}`,
                    {
                        user: this.user
                    },
                    {
                        headers: {
                            'Authorization': 'Bearer ' + this.token
                        },
                    })
                this.$parent.$emit('userChanged')
                this.$modal.hide('UsersEditForm')
            } catch (e) {
                this.$notify({
                    text: e,
                    type: 'error'
                })
            }
        },
        async fetchUserData() {
            try {
                const {data} = await axios.get(`/api/users/${this.userId}`, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                })

                for (const field in data.userData) {
                    if (field === 'filial') {
                        this.user[field] = data.userData[field] ? data.userData[field].id : null
                    } else if (field === 'roles') {
                        this.user['role'] = _.head(data.userData['roles']).name
                    } else {
                        this.user[field] = data.userData[field]
                    }
                }
                this.roles = data.roles
                console.log('data.filials', data.filials)
                this.filials = data.filials
            } catch (e) {
                this.$notify({
                    text: e,
                    type: 'error'
                })
            }
        },
        // async fetchUsersData() {
        //     try {
        //         const {data} = await axios.get('/api/users-data', {
        //             headers: {
        //                 'Authorization': 'Bearer ' + this.token
        //             }
        //         })
        //         this.roles = data.roles
        //         this.filials = data.filials
        //     } catch (e) {
        //         this.$notify({
        //             text: e,
        //             type: 'error'
        //         })
        //     }
        // }
    },
    async mounted() {
        await this.fetchUserData()
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
