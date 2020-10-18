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

        <div class="bg-white fixed w-full pl-64 left-0 shadow z-10 bottom-0">
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
    methods: {
        async addWorksheet() {

            try {
                let isValid = []
                isValid.push(await this.$refs.common.$refs.commonValidationObserver.validate())
                isValid.push(await this.$refs.passport.$refs.passportValidationObserver.validate())
                isValid.push(this.$refs.creditors.$refs.creditorsValidationObserver ? await this.$refs.creditors.$refs.creditorsValidationObserver?.validate() : true)
                isValid.push(this.$refs.marital.$refs.maritalValidationObserver ? await this.$refs.marital.$refs.maritalValidationObserver?.validate() : true)

                console.log('isValid', isValid)
                if (_.every(isValid, item => item === true)) {
                    console.log('this.token', this.token)
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
                }

            } catch (e) {
                console.log(e)
            }
        }
    }
}
</script>

<style scoped>

</style>
