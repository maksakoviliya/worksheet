<template>
    <nav v-if="tablePagination && lastPage > firstPage" class="relative z-0 inline-flex shadow-sm users-pagination">
        <a v-if="!isOnFirstPage"
           aria-label="Previous"
           class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
           href="#"
           @click.prevent="loadPage('prev')">
            <!-- Heroicon name: chevron-left -->
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      fill-rule="evenodd"/>
            </svg>
        </a>

        <template v-if="notEnoughPages">
            <template v-for="(n, i) in totalPage">
                <a :key="i" :class="[isCurrentPage(i+firstPage) ? 'bg-indigo-100' : '']"
                   class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                   href="#"
                   @click.prevent="loadPage(i+firstPage)">
                    {{ n }}
                </a>
            </template>
        </template>
        <template v-else>
            <template v-for="(n, i) in windowSize">
                <a :key="i" :class="[$_css.pageClass, isCurrentPage(windowStart+i+firstPage-1) ? $_css.activeClass : '']"
                   @click="loadPage(windowStart+i+firstPage-1)"
                   v-html="windowStart+n-1">
                </a>
            </template>
        </template>

        <a v-if="!isOnLastPage"
           aria-label="Next"
           class="-ml-px relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
           href="#"
           @click.prevent="loadPage('next')">
            <!-- Heroicon name: chevron-right -->
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      fill-rule="evenodd"/>
            </svg>
        </a>
    </nav>
</template>

<script>
import PaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin.vue'

export default {
    mixins: [PaginationMixin],
    props: {
        links: Array
    }
}
</script>

<style lang="scss">
.users-pagination {
    a{
        &:first-child{
            @apply rounded-l-md;
        }
        &:last-child{
            @apply rounded-r-md;
        }
    }
}
</style>

