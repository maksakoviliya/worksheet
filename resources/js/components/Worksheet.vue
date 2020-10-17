<template>
    <div class="flex mt-8 items-start relative">
        <div class="w-full">
            <!--            <scrollactive :duration="800" :offset="0" active-class="active" bezier-easing-value=".5,0,.35,1"/>-->
            <common-data :data.sync="worksheet.common" @change="worksheet.common = $event"/>
            <passport :data.sync="worksheet.passport" @change="worksheet.passport = $event" class="mt-6"/>
            <creditors :data.sync="worksheet.creditors" @change="worksheet.creditors = $event" class="mt-6"/>
            <income :data.sync="worksheet.income" @change="worksheet.income = $event" class="mt-6"/>
            <marital-status class="mt-6"/>
            <children class="mt-6"/>
            <immovable class="mt-6"/>
            <movable class="mt-6"/>
            <spouses-immovable class="mt-6"/>
            <spouses-movable class="mt-6"/>
            <voidable class="mt-6"/>
            <payment class="mt-6"/>
        </div>
        <!--        <worksheet-nav class="sticky" style="top: 90px;"></worksheet-nav>-->
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
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
