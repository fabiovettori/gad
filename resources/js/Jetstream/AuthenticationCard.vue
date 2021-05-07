<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <teleport to="head">
            <title>GAD - {{ title }}</title>
        </teleport>

        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-white text-2xl font-bold text-center py-5">Welcome at GAD Registry</h1>
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: String,
        }
    }
</script>
