<template>
    <div class="flex mt-8 items-start relative">
        <notifications/>
        <div class="w-full">
            <!--            <scrollactive :duration="800" :offset="0" active-class="active" bezier-easing-value=".5,0,.35,1"/>-->
            <common-data ref="common" :token="token" :filial="filial" :required-for-email="requiredForEmail"
                         :data.sync="worksheet.common"
                         @change="worksheet.common = $event"/>
            <passport ref="passport" :data.sync="worksheet.passport" :required-for-email="requiredForEmail" class="mt-6"
                      @change="worksheet.passport = $event"/>
            <creditors ref="creditors" :data.sync="worksheet.creditors" class="mt-6"
                       @change="worksheet.creditors = $event" :token="token"/>
            <income ref="income" :data.sync="worksheet.income" class="mt-6" @change="worksheet.income = $event"/>
            <marital-status ref="marital" :data.sync="worksheet.marital" class="mt-6"
                            @change="worksheet.marital = $event"/>
            <children ref="children" :data.sync="worksheet.children" class="mt-6"
                      @change="worksheet.children = $event"/>
            <immovable :data.sync="worksheet.immovable" class="mt-6" @change="worksheet.immovable = $event"/>
            <movable :data.sync="worksheet.movable" class="mt-6" @change="worksheet.movable = $event"/>
            <spouses-immovable v-if="worksheet.marital.isMarried" :data.sync="worksheet.spousesImmovable"
                               class="mt-6" @change="worksheet.spousesImmovable = $event"/>
            <spouses-movable v-if="worksheet.marital.isMarried" :data.sync="worksheet.spousesMovable"
                             class="mt-6" @change="worksheet.spousesMovable = $event"/>
            <voidable-movable :data.sync="worksheet.voidableMovable" @change="worksheet.voidableMovable = $event"
                              class="mt-6"></voidable-movable>
            <voidable-immmovable :data.sync="worksheet.voidableImmovable" @change="worksheet.voidableImmovable = $event"
                                 class="mt-6"></voidable-immmovable>

            <payment :data.sync="worksheet.payment" :filial="worksheet.common.filial_id" :token="token" class="mt-6"
                     @change="worksheet.payment = $event"/>
        </div>
        <!--        <worksheet-nav class="sticky" style="top: 90px;"></worksheet-nav>-->

        <div class="bg-white fixed w-full left-0 shadow z-10 bottom-0" v-if="editing">
            <div class="container mx-auto pr-6 py-3 text-right flex justify-between">
                <!--                :class="{'opacity-50 cursor-not-allowed': invalid}"-->
                <button
                    class="px-6 py-2 inline-flex bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    :class="loading ? 'cursor-not-allowed pointer-events-none opacity-50' : ''"
                    v-if="!this.in_planfix"
                    :disabled="loading"
                    @click="sendEmail">
                    <svg class="animate-spin fill-current color-white h-5 w-5 mr-3" v-if="loading"
                         viewBox="0 0 26.349 26.35">
                        <circle cx="13.792" cy="3.082" r="3.082"/>
                        <circle cx="13.792" cy="24.501" r="1.849"/>
                        <circle cx="6.219" cy="6.218" r="2.774"/>
                        <circle cx="21.365" cy="21.363" r="1.541"/>
                        <circle cx="3.082" cy="13.792" r="2.465"/>
                        <circle cx="24.501" cy="13.791" r="1.232"/>
                        <path
                            d="M4.694 19.84a2.155 2.155 0 000 3.05 2.155 2.155 0 003.05 0 2.155 2.155 0 000-3.05 2.146 2.146 0 00-3.05 0z"/>
                        <circle cx="21.364" cy="6.218" r=".924"/>
                    </svg>
                    Передать в Planfix
                </button>
                <button
                    class="px-6 py-2 inline-flex bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    v-else
                    :class="loading ? 'cursor-not-allowed pointer-events-none opacity-50' : ''"
                    :disabled="loading"
                    @click="sendClearEmail">
                    <svg class="animate-spin fill-current color-white h-5 w-5 mr-3" v-if="loading"
                         viewBox="0 0 26.349 26.35">
                        <circle cx="13.792" cy="3.082" r="3.082"/>
                        <circle cx="13.792" cy="24.501" r="1.849"/>
                        <circle cx="6.219" cy="6.218" r="2.774"/>
                        <circle cx="21.365" cy="21.363" r="1.541"/>
                        <circle cx="3.082" cy="13.792" r="2.465"/>
                        <circle cx="24.501" cy="13.791" r="1.232"/>
                        <path
                            d="M4.694 19.84a2.155 2.155 0 000 3.05 2.155 2.155 0 003.05 0 2.155 2.155 0 000-3.05 2.146 2.146 0 00-3.05 0z"/>
                        <circle cx="21.364" cy="6.218" r=".924"/>
                    </svg>
                    Очистить данные в Planfix
                </button>
                <div class="ml-auto flex items-center">
                    <button
                        class="px-6 py-2 inline-flex bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                        type="button"
                        :class="loading ? 'cursor-not-allowed pointer-events-none opacity-50' : ''"
                        :disabled="loading"
                        @click="saveWorksheet(false)">
                        <svg class="animate-spin fill-current color-white h-5 w-5 mr-3" v-if="loading"
                             viewBox="0 0 26.349 26.35">
                            <circle cx="13.792" cy="3.082" r="3.082"/>
                            <circle cx="13.792" cy="24.501" r="1.849"/>
                            <circle cx="6.219" cy="6.218" r="2.774"/>
                            <circle cx="21.365" cy="21.363" r="1.541"/>
                            <circle cx="3.082" cy="13.792" r="2.465"/>
                            <circle cx="24.501" cy="13.791" r="1.232"/>
                            <path
                                d="M4.694 19.84a2.155 2.155 0 000 3.05 2.155 2.155 0 003.05 0 2.155 2.155 0 000-3.05 2.146 2.146 0 00-3.05 0z"/>
                            <circle cx="21.364" cy="6.218" r=".924"/>
                        </svg>
                        Изменить анкету
                    </button>
                    <button
                        class="px-6 py-2 inline-flex bg-red-600 rounded-md text-white text-sm hover:bg-red-500 ml-2 focus:outline-none focus:shadow"
                        @click="showDeleteWorksheetForm(worksheetData.id)" type="button"
                        :class="loading ? 'cursor-not-allowed pointer-events-none opacity-50' : ''"
                        :disabled="loading">
                        Удалить анкету
                    </button>
                    <a
                        href="/worksheets"
                        class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                        type="button">Отменить
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-white fixed w-full pl-64 left-0 shadow z-10 bottom-0" v-else>
            <div class="container mx-auto px-6 py-3 text-right">
                <!--                :class="{'opacity-50 cursor-not-allowed': invalid}"-->
                <button
                    class="px-6 py-2 bg-green-600 inline-flex rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    :class="loading ? 'cursor-not-allowed pointer-events-none opacity-50' : ''"
                    :disabled="loading"
                    @click="addWorksheet">
                    <svg class="animate-spin fill-current color-white h-5 w-5 mr-3" v-if="loading"
                         viewBox="0 0 26.349 26.35">
                        <circle cx="13.792" cy="3.082" r="3.082"/>
                        <circle cx="13.792" cy="24.501" r="1.849"/>
                        <circle cx="6.219" cy="6.218" r="2.774"/>
                        <circle cx="21.365" cy="21.363" r="1.541"/>
                        <circle cx="3.082" cy="13.792" r="2.465"/>
                        <circle cx="24.501" cy="13.791" r="1.232"/>
                        <path
                            d="M4.694 19.84a2.155 2.155 0 000 3.05 2.155 2.155 0 003.05 0 2.155 2.155 0 000-3.05 2.146 2.146 0 00-3.05 0z"/>
                        <circle cx="21.364" cy="6.218" r=".924"/>
                    </svg>
                    Добавить анкету
                </button>
                <a
                    href="/worksheets"
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button">Отменить
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import WorksheetNav from "./WorksheetNav";
import CommonData from "./Fields/CommonData";
import Passport from "./Fields/Passport";
import Creditors from "./Fields/Creditors";
import Income from "./Fields/Income";
import MaritalStatus from "./Fields/MaritalStatus";
import Children from "./Fields/Children";
import Immovable from "./Fields/Immovable";
import Movable from "./Fields/Movable";
import SpousesImmovable from "./Fields/SpousesImmovable";
import SpousesMovable from "./Fields/SpousesMovable";
import Payment from "./Fields/Payment";
import axios from "axios";
import VoidableMovable from "./Fields/VoidableMovable";
import VoidableImmovable from "./Fields/VoidableImmovable";
import DeleteConfirmation from "./DeleteConfirmation";

export default {
    name: "Worksheet",
    components: {
        WorksheetNav,
        CommonData,
        Passport,
        Creditors,
        Income,
        MaritalStatus,
        Children,
        Immovable,
        Movable,
        SpousesImmovable,
        SpousesMovable,
        Payment,
        VoidableMovable,
        'voidable-immmovable': VoidableImmovable
    },
    props: {
        token: {
            required: true,
            type: String
        },
        userId: {
            required: true,
        },
        filial: {
            required: true
        },
        worksheetData: {
            required: false
        }
    },
    data() {
        return {
            loading: false,
            requiredForEmail: false,
            worksheet: {
                common: {
                    envyID: '',
                    name: '',
                    surname: '',
                    patronymic: '',
                    phone: '',
                    email: '',
                    messengers: [],
                    livingCity: '',
                    filial_id: this.filial
                },
                passport: {
                    birthday: '',
                    series: '',
                    number: '',
                    issued: '',
                    code: '',
                    issuedBy: '',
                    born: '',
                    region: '',
                    area: '',
                    city: '',
                    street: '',
                    house: '',
                    housing: '',
                    room: '',
                    registration: '',
                    post: ''
                },
                creditors: {
                    creditors: [],
                    nextPayment: ''
                },
                income: {
                    sources: [],
                    isIp: false,
                    isDirector: false,
                    oooComment: '',
                },
                marital: {
                    isMarried: false,
                    spouse: ''
                },
                children: {
                    children: [],
                },
                immovable: {
                    immovable: [],
                },
                movable: {
                    movable: [],
                },
                spousesImmovable: {
                    spousesImmovable: [],
                },
                spousesMovable: {
                    spousesMovable: [],
                },
                voidableMovable: {
                    voidableMovable: []
                },
                voidableImmovable: {
                    voidableImmovable: []
                },
                payment: {
                    payment: []
                }
            },
            in_planfix: false
        }
    },
    computed: {
        editing() {
            return !!this.worksheetData
        }
    },
    methods: {
        async addWorksheet() {
            try {
                this.loading = true
                let isValid = []
                isValid.push(await this.$refs.common.$refs.commonValidationObserver.validate())
                isValid.push(await this.$refs.passport.$refs.passportValidationObserver.validate())
                isValid.push(this.$refs.creditors.$refs.creditorsValidationObserver ? await this.$refs.creditors.$refs.creditorsValidationObserver?.validate() : true)
                isValid.push(this.$refs.marital.$refs.maritalValidationObserver ? await this.$refs.marital.$refs.maritalValidationObserver?.validate() : true)
                if (_.every(isValid, item => item === true)) {
                    await axios.post('/api/worksheets', {
                        // Common
                        envyID: this.worksheet.common.envyID,
                        surname: this.worksheet.common.surname,
                        name: this.worksheet.common.name,
                        patronymic: this.worksheet.common.patronymic,
                        phone: this.worksheet.common.phone,
                        email: this.worksheet.common.email,
                        messengers: this.worksheet.common.messengers,
                        livingCity: this.worksheet.common.livingCity,
                        filial_id: this.worksheet.common.filial_id,
                        // Passport
                        birthday: this.worksheet.passport.birthday,
                        series: this.worksheet.passport.series,
                        number: this.worksheet.passport.number,
                        issued: this.worksheet.passport.issued,
                        code: this.worksheet.passport.code,
                        issuedBy: this.worksheet.passport.issuedBy,
                        born: this.worksheet.passport.born,
                        index: this.worksheet.passport.index,
                        region: this.worksheet.passport.region,
                        area: this.worksheet.passport.area,
                        city: this.worksheet.passport.city,
                        street: this.worksheet.passport.street,
                        house: this.worksheet.passport.house,
                        housing: this.worksheet.passport.housing,
                        room: this.worksheet.passport.room,
                        registration: this.worksheet.passport.registration,
                        post: this.worksheet.passport.post,
                        // Creditors
                        creditors: this.worksheet.creditors.creditors,
                        nextPayment: this.worksheet.creditors.nextPayment,
                        // Income
                        sources: this.worksheet.income.sources,
                        isIp: this.worksheet.income.isIp,
                        isDirector: this.worksheet.income.isDirector,
                        oooComment: this.worksheet.income.oooComment,
                        // Marital
                        isMarried: this.worksheet.marital.isMarried,
                        spouse: this.worksheet.marital.spouse,
                        // Children
                        children: this.worksheet.children.children,
                        // Immovable
                        immovable: this.worksheet.immovable.immovable,
                        // Movable
                        movable: this.worksheet.movable.movable,
                        // spousesImmovable
                        spousesImmovable: this.worksheet.spousesImmovable.spousesImmovable,
                        // spousesMovable
                        spousesMovable: this.worksheet.spousesMovable.spousesMovable,
                        // voidable
                        voidableMovable: this.worksheet.voidableMovable.voidableMovable,
                        voidableImmovable: this.worksheet.voidableImmovable.voidableImmovable,
                        // payment
                        payment: this.worksheet.payment.payment,

                        // temp
                        user_id: this.userId
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' + this.token
                        },
                    })
                    window.location.href = '/worksheets'
                } else {
                    this.$notify({
                        title: 'Ошибка валидации',
                        text: 'Необходимо заполнить обязательные поля',
                        type: 'error',
                        position: 'bottom right'
                    })
                }

            } catch (e) {
                this.loading = false

                this.$notify({
                    title: 'Ошибка сервера',
                    text: e,
                    type: 'error',
                    position: 'bottom right'
                })
            }
        },
        async saveWorksheet(redirect = true) {
            try {
                this.loading = true
                let isValid = []
                isValid.push(await this.$refs.common.$refs.commonValidationObserver.validate())
                isValid.push(await this.$refs.passport.$refs.passportValidationObserver.validate())
                isValid.push(this.$refs.creditors.$refs.creditorsValidationObserver ? await this.$refs.creditors.$refs.creditorsValidationObserver?.validate() : true)
                isValid.push(this.$refs.marital.$refs.maritalValidationObserver ? await this.$refs.marital.$refs.maritalValidationObserver?.validate() : true)
                if (_.every(isValid, item => item === true)) {
                    await axios.put(`/api/worksheets/${this.worksheetData.id}`, {
                        // Common
                        envyID: this.worksheet.common.envyID,
                        surname: this.worksheet.common.surname,
                        name: this.worksheet.common.name,
                        patronymic: this.worksheet.common.patronymic,
                        phone: this.worksheet.common.phone,
                        email: this.worksheet.common.email,
                        messengers: this.worksheet.common.messengers,
                        livingCity: this.worksheet.common.livingCity,
                        filial_id: this.worksheet.common.filial_id,
                        // Passport
                        birthday: this.worksheet.passport.birthday,
                        series: this.worksheet.passport.series,
                        number: this.worksheet.passport.number,
                        issued: this.worksheet.passport.issued,
                        code: this.worksheet.passport.code,
                        issuedBy: this.worksheet.passport.issuedBy,
                        born: this.worksheet.passport.born,
                        index: this.worksheet.passport.index,
                        region: this.worksheet.passport.region,
                        area: this.worksheet.passport.area,
                        city: this.worksheet.passport.city,
                        street: this.worksheet.passport.street,
                        house: this.worksheet.passport.house,
                        housing: this.worksheet.passport.housing,
                        room: this.worksheet.passport.room,
                        registration: this.worksheet.passport.registration,
                        post: this.worksheet.passport.post,
                        // Creditors
                        creditors: this.worksheet.creditors.creditors,
                        nextPayment: this.worksheet.creditors.nextPayment,
                        // Income
                        sources: this.worksheet.income.sources,
                        isIp: this.worksheet.income.isIp,
                        isDirector: this.worksheet.income.isDirector,
                        oooComment: this.worksheet.income.oooComment,
                        // Marital
                        isMarried: this.worksheet.marital.isMarried,
                        spouse: this.worksheet.marital.spouse,
                        // Children
                        children: this.worksheet.children.children,
                        // Immovable
                        immovable: this.worksheet.immovable.immovable,
                        // Movable
                        movable: this.worksheet.movable.movable,
                        // spousesImmovable
                        spousesImmovable: this.worksheet.spousesImmovable.spousesImmovable,
                        // spousesMovable
                        spousesMovable: this.worksheet.spousesMovable.spousesMovable,
                        // voidable
                        voidableMovable: this.worksheet.voidableMovable.voidableMovable,
                        voidableImmovable: this.worksheet.voidableImmovable.voidableImmovable,
                        // payment
                        payment: this.worksheet.payment.payment,
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' + this.token
                        },
                    })
                    if (redirect) {
                        window.location.href = '/worksheets'
                    }
                } else {
                    this.$notify({
                        title: 'Ошибка валидации',
                        text: 'Необходимо заполнить обязательные поля',
                        type: 'error'
                    })
                }

            } catch (e) {
                this.$notify({
                    title: 'Ошибка сервера',
                    text: 'Что-то пошло не так',
                    type: 'error'
                })
            } finally {
                this.loading = false
            }
        },
        async sendEmail() {
            try {
                this.loading = true
                this.requiredForEmail = true

                const common = await this.$refs.common.$refs.commonValidationObserver.validate()
                const passport = await this.$refs.passport.$refs.passportValidationObserver.validate()

                // console.log(common)
                // console.log(passport)
                if (common && passport) {
                    await this.saveWorksheet(false)
                    this.$notify({
                        title: 'Анкета сохранена',
                        text: 'Все данные успешно обновлены',
                        type: 'success'
                    })

                    try {
                        const {data} = await axios.post('/api/send-email', {
                            id: this.worksheetData.id
                        },{
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        this.requiredForEmail = false
                        this.in_planfix = true
                    } catch (e) {
                        this.$notify({
                            title: 'Ошибка сервера',
                            text: e,
                            type: 'error'
                        })
                    }

                } else {
                    this.loading = false
                    this.$notify({
                        title: 'Ошибка валидации',
                        text: 'Необходимо заполнить обязательные поля',
                        type: 'error'
                    })
                }
            } catch (e) {
                console.log(e)
                this.loading = false
                this.$notify({
                    title: 'Ошибка валидации',
                    text: 'Необходимо заполнить обязательные поля',
                    type: 'error'
                })
            }
        },
        async sendClearEmail() {
            try {
                const {data} = await axios.post('/api/send-clear-email', {
                    id: this.worksheetData.id
                },{
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                })
                this.requiredForEmail = false
                this.in_planfix = false
            } catch (e) {
                this.$notify({
                    title: 'Ошибка сервера',
                    text: e,
                    type: 'error'
                })
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
                this.$notify({
                    title: 'Все получилось!',
                    text: 'Анкета удален успешно',
                    type: 'success'
                })
                window.location.href = "/worksheets";
            } catch (e) {
                this.$notify({
                    title: 'Ошибка!',
                    text: 'Анкета не удалена',
                    type: 'error'
                })
            }
        }
    },
    mounted() {
        if (this.worksheetData) {
            // console.log('this.worksheetData', this.worksheetData)
            // Common
            this.worksheet.common.envyID = this.worksheetData.envyID || ''
            this.worksheet.common.surname = this.worksheetData.surname || ''
            this.worksheet.common.name = this.worksheetData.name || ''
            this.worksheet.common.patronymic = this.worksheetData.patronymic || ''
            this.worksheet.common.phone = this.worksheetData.phone || ''
            this.worksheet.common.email = this.worksheetData.email || ''
            this.worksheet.common.messengers = this.worksheetData.messengers || []
            this.worksheet.common.livingCity = this.worksheetData.livingCity || ''
            this.worksheet.common.filial_id = this.worksheetData.filial_id || this.filial
            // Passport
            this.worksheet.passport.birthday = this.worksheetData.birthday || ''
            this.worksheet.passport.series = this.worksheetData.series || ''
            this.worksheet.passport.number = this.worksheetData.number || ''
            this.worksheet.passport.issued = this.worksheetData.issued || ''
            this.worksheet.passport.code = this.worksheetData.code || ''
            this.worksheet.passport.issuedBy = this.worksheetData.issuedBy || ''
            this.worksheet.passport.born = this.worksheetData.born || ''
            this.worksheet.passport.index = this.worksheetData.index || ''
            this.worksheet.passport.region = this.worksheetData.region || ''
            this.worksheet.passport.area = this.worksheetData.area || ''
            this.worksheet.passport.city = this.worksheetData.city || ''
            this.worksheet.passport.street = this.worksheetData.street || ''
            this.worksheet.passport.house = this.worksheetData.house || ''
            this.worksheet.passport.housing = this.worksheetData.housing || ''
            this.worksheet.passport.room = this.worksheetData.room || ''
            this.worksheet.passport.registration = this.worksheetData.registration || ''
            this.worksheet.passport.post = this.worksheetData.post || ''
            // Creditors
            this.worksheet.creditors.creditors = this.worksheetData.creditors
            this.worksheet.creditors.nextPayment = this.worksheetData.nextPayment
            // Income
            this.worksheet.income.sources = this.worksheetData.sources
            this.worksheet.income.isIp = this.worksheetData.isIp
            this.worksheet.income.isDirector = this.worksheetData.isDirector
            this.worksheet.income.oooComment = this.worksheetData.oooComment
            // Marital
            this.worksheet.marital.isMarried = this.worksheetData.isMarried
            this.worksheet.marital.spouse = this.worksheetData.spouse
            // Children
            this.worksheet.children.children = this.worksheetData.children
            // Immovable
            this.worksheet.immovable.immovable = this.worksheetData.immovable
            // Movable
            this.worksheet.movable.movable = this.worksheetData.movable
            // spousesImmovable
            this.worksheet.spousesImmovable.spousesImmovable = this.worksheetData.spousesImmovable
            // spousesMovable
            this.worksheet.spousesMovable.spousesMovable = this.worksheetData.spousesMovable
            // voidable
            this.worksheet.voidableMovable.voidableMovable = this.worksheetData.voidableMovable
            this.worksheet.voidableImmovable.voidableImmovable = this.worksheetData.voidableImmovable
            // payment
            this.worksheet.payment.payment = this.worksheetData.payment

            this.in_planfix = this.worksheetData.in_planfix
        }
    }
}
</script>
