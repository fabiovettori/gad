<template>
    <div class="h-full p-5 test">
        <div class="h-1/5">
            <a href="https://gadstudio.eu/en/home/" class="flex justify-center">
                <img src="/images/gadstudio-logo-white.png" alt="gad studio logo" class="max-h-12">
            </a>
        </div>

        <div class="flex flex-col items-center justify-start h-3/5">
            <inertia-link class="text-white hover:text-green-400 text-xl font-semibold mb-9" :href="route('welcome')"> Welcome </inertia-link>
            <inertia-link v-show="$page.props.user.permissions[0].id == 1"
            class="text-white hover:text-green-400 text-xl font-semibold mb-9" :href="route('permissions')"> Permissions </inertia-link>
            <inertia-link class="text-white hover:text-green-400 text-xl font-semibold mb-9" :href="route('registry.index')"> Registry </inertia-link>
        </div>

        <div class="flex items-end justify-center h-1/5">
            <a href="https://www.facebook.com/gadstudioengineering/" class="flex items-center justify-center block w-10 h-10 rounded-full border-0 bg-green-400 border-green-400 social">
                <span class="fab fa-facebook-f text-gray-800 text-lg"></span>
            </a>
            <a href="https://www.instagram.com/gadstudio.eu/?hl=it" class="flex items-center justify-center block w-10 h-10 rounded-full border-0 bg-green-400 border-green-400 mx-3 social">
                <span class="fab fa-instagram text-gray-800 text-lg"></span>
            </a>
            <a href="https://www.linkedin.com/company/globalassistancedevelopment/" class="flex items-center justify-center block w-10 h-10 rounded-full border-0 bg-green-400 border-green-400 social">
                <span class="fab fa-linkedin-in text-gray-800 text-lg"></span>
            </a>
        </div>
    </div>
</template>

<script>

export default {
    props: {

    },
    methods: {

    }
}
</script>

<style>
    .test {
        background-image: url('/images/arch-bg.jpg');
        background-color: #1f2937;
        background-size: auto 100%;
        background-blend-mode: multiply;
        background-position: bottom left;
        background-repeat: no-repeat;
    }

    .social:hover span {
        color: white;
    }
</style>
