<template>
    <div class="flex mt-8 items-start relative">

        <div class="w-full">
            <voidable-movable :data.sync="voidableMovable"
                              @change="voidableMovable = $event"></voidable-movable>
            <voidable-immmovable :data.sync="voidableImmovable"
                                 @change="voidableImmovable = $event"
                                 class="mt-6"></voidable-immmovable>
        </div>


        <div class="bg-white fixed w-full pl-64 left-0 shadow z-10 bottom-0">
            <div class="container mx-auto px-6 py-3 text-right">
                <!--                :class="{'opacity-50 cursor-not-allowed': invalid}"-->
                <button
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    v-if="editing"
                >Изменить анкету
                    <!--                    @click="saveWorksheet">Изменить анкету-->
                </button>
                <button
                    class="px-6 py-2 bg-green-600 rounded-md text-white text-sm hover:bg-green-500 focus:outline-none focus:shadow"
                    type="button"
                    v-else
                >Добавить анкету
                    <!--                    @click="addWorksheet">Добавить анкету-->
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
import VoidableMovable from "./Fields/VoidableMovable";
import VoidableImmovable from "./Fields/VoidableImmovable";

export default {
    name: "VoidableCreate",
    components: {
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
            default: []
        },
        worksheetData: {
            required: false
        }
    },
    data() {
        return {
            voidableMovable: {
                voidableMovable: []
            },
            voidableImmovable: {
                voidableImmovable: []
            }
        }
    },
    computed: {
        editing() {
            return !!this.worksheetData
        }
    },
}
</script>

<style scoped>

</style>
