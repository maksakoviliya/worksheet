<template>
    <div class="text-center">
        <div>Вы действительно хотите удалить {{ data.type }}?</div>

        <div class="mt-6">
            <button
                class="px-6 py-2 bg-red-600 rounded-md text-white text-sm hover:bg-red-500 focus:outline-none focus:shadow"
                @click="confirm"
                type="button">Удалить
            </button>
            <button
                class="px-6 py-2 bg-gray-300 rounded-md text-gray-900 text-sm hover:bg-gray-400 ml-2 focus:outline-none focus:shadow"
                type="button" @click="$modal.hide('DeleteConfirmation')">Отменить
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "DeleteConfirmation",
    props: [
        'data'
    ],
    methods: {
        confirm() {
            this.$parent.$emit('onConfirm')
            this.$modal.hide('DeleteConfirmation')
        }
    }
}
</script>
