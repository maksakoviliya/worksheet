<template>
    <div class="flex mt-8 items-start relative">

        <div class="w-full">
            <!--            <scrollactive :duration="800" :offset="0" active-class="active" bezier-easing-value=".5,0,.35,1"/>-->
            <common-data ref="common" :data.sync="worksheet.common" @change="worksheet.common = $event"/>
            <passport ref="passport" :data.sync="worksheet.passport" class="mt-6"
                      @change="worksheet.passport = $event"/>
            <creditors ref="creditors" :data.sync="worksheet.creditors" class="mt-6"
                       @change="worksheet.creditors = $event"/>
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
            <voidable :data.sync="worksheet.voidable" class="mt-6" @change="worksheet.voidable = $event"/>
            <payment :data.sync="worksheet.payment" class="mt-6" @change="worksheet.payment = $event"/>
        </div>
        <!--        <worksheet-nav class="sticky" style="top: 90px;"></worksheet-nav>-->

        <div class="bg-white fixed w-full pl-64 left-0 shadow z-10 bottom-0"  v-if="editing" >
            <div class="container mx-auto px-6 py-3 text-right">
                <!--                :class="{'opacity-50 cursor-not-allowed': invalid}"-->
                <button
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    @click="saveWorksheet">Изменить анкету
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button">Отменить
                </button>
            </div>
        </div>
        <div class="bg-white fixed w-full pl-64 left-0 shadow z-10 bottom-0" v-else>
            <div class="container mx-auto px-6 py-3 text-right">
                <!--                :class="{'opacity-50 cursor-not-allowed': invalid}"-->
                <button
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    @click="addWorksheet">Добавить анкету
                </button>
                <button
                    class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                    type="button">Отменить
                </button>
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
import Voidable from "./Fields/Voidable";
import Payment from "./Fields/Payment";
import axios from "axios";

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
        Voidable,
        Payment
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
            default: []
        },
        worksheetData: {
            required: false
        }
    },
    data() {
        return {
            worksheet: {
                common: {
                    envyID: '',
                    name: '',
                    phone: '',
                    email: '',
                    messengers: [],
                    livingCity: '',
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
                voidable: {
                    voidable: []
                },
                payment: {
                    payment: []
                }
            }
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
                let isValid = []
                isValid.push(await this.$refs.common.$refs.commonValidationObserver.validate())
                isValid.push(await this.$refs.passport.$refs.passportValidationObserver.validate())
                isValid.push(this.$refs.creditors.$refs.creditorsValidationObserver ? await this.$refs.creditors.$refs.creditorsValidationObserver?.validate() : true)
                isValid.push(this.$refs.marital.$refs.maritalValidationObserver ? await this.$refs.marital.$refs.maritalValidationObserver?.validate() : true)

                if (_.every(isValid, item => item === true)) {
                    await axios.post('/api/worksheets', {
                        // Common
                        envyID: this.worksheet.common.envyID,
                        name: this.worksheet.common.name,
                        phone: this.worksheet.common.phone,
                        email: this.worksheet.common.email,
                        messengers: this.worksheet.common.messengers,
                        livingCity: this.worksheet.common.livingCity,
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
                        voidable: this.worksheet.voidable.voidable,
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
                }

            } catch (e) {
                console.log(e)
            }
        },
        async saveWorksheet() {
            console.log('Change worksheet')
            try {
                let isValid = []
                isValid.push(await this.$refs.common.$refs.commonValidationObserver.validate())
                isValid.push(await this.$refs.passport.$refs.passportValidationObserver.validate())
                isValid.push(this.$refs.creditors.$refs.creditorsValidationObserver ? await this.$refs.creditors.$refs.creditorsValidationObserver?.validate() : true)
                isValid.push(this.$refs.marital.$refs.maritalValidationObserver ? await this.$refs.marital.$refs.maritalValidationObserver?.validate() : true)

                if (_.every(isValid, item => item === true)) {
                    await axios.put(`/api/worksheets/${this.worksheetData.id}`, {
                        // Common
                        envyID: this.worksheet.common.envyID,
                        name: this.worksheet.common.name,
                        phone: this.worksheet.common.phone,
                        email: this.worksheet.common.email,
                        messengers: this.worksheet.common.messengers,
                        livingCity: this.worksheet.common.livingCity,
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
                        voidable: this.worksheet.voidable.voidable,
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
                }

            } catch (e) {
                console.log(e)
            }
        }
    },
    mounted() {
        if (this.worksheetData) {
            // Common
            this.worksheet.common.envyID = this.worksheetData.envyID || ''
            this.worksheet.common.name = this.worksheetData.name || ''
            this.worksheet.common.phone = this.worksheetData.phone || ''
            this.worksheet.common.email = this.worksheetData.email || ''
            this.worksheet.common.messengers = this.worksheetData.messengers || []
            this.worksheet.common.livingCity = this.worksheetData.livingCity || ''
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
            this.worksheet.voidable.voidable = this.worksheetData.voidable
            // payment
            this.worksheet.payment.payment = this.worksheetData.payment

            // temp
            this.userI = this.worksheetData.user_id
        }
    }
}
</script>

<style scoped>

</style>
