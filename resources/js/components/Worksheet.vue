<template>
    <div class="flex mt-8 items-start relative">
        <div class="w-full">
<!--            <scrollactive :duration="800" :offset="0" active-class="active" bezier-easing-value=".5,0,.35,1"/>-->
            <common-data/>
            <passport class="mt-6"/>
            <creditors class="mt-6"/>
            <income class="mt-6"/>
            <marital-status class="mt-6"/>
            <children class="mt-6"/>
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

export default {
    name: "Worksheet",
    components: {
        WorksheetNav,
        CommonData,
        Passport,
        Creditors,
        Income,
        MaritalStatus,
        Children
    }
}
</script>

<style scoped>

</style>
