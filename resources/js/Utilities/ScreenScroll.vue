<template>
    <div class="fixed right-0 bottom-0">
        <span @click="$emit('scroll', 1)" class="controls fas fa-chevron-up text-white mb-3 mr-5 bg-purple-500 opacity-50 hover:opacity-100 flex items-center justify-center rounded-full cursor-pointer shadow-lg"></span>
        <span @click="$emit('scroll', 0)" class="controls fas fa-chevron-down text-white opacity-50 hover:opacity-100 mb-5 mr-5 bg-purple-500 flex items-center justify-center rounded-full cursor-pointer shadow-lg"></span>
    </div>
</template>

<script>
export default {
    methods: {

    }
}
</script>

<style scoped>
    .controls {
        width: 30px;
        height: 30px;
    }
</style>
