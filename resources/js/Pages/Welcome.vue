<template>
    <app-layout :scrollable="false" :title="'Welcome'" :contentStyle="'height: calc(100vh - 70px); background-color: white; display: flex; align-items: center; justify-content: center; background-image: url(/images/construction-process.jpg); background-size: cover;'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Welcome
            </h2>
        </template>

        <template #default>
            <div class="hero w-10/12 h-4/5 rounded-3xl flex items-start justify-center flex-col p-12 relative">
                <h1 class="uppercase text-white text-5xl font-bold mt-3 mb-8 max-w-3xl leading-tight">a comprensive and efficient <br> range of service.</h1>
                <p class="text-white text-2xl font-medium mb-12 max-w-3xl leading-10"><span class="capitalize text-3xl font-extrabold">project management software solutions <br></span> for designers, builders, property developers, <br> engineering companies and architecture firms.</p>
                <a href="https://gadstudio.eu/en/contacts/" class="py-3 px-5 rounded-lg bg-green-500 uppercase text-white text-l tracking-wide font-bold">contact us</a>
                <span class="absolute text-sm text-white font-medium right-6 bottom-1">Global Assistance Development S.r.l.</span>
            </div>
        </template>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        mounted(){
            console.log('Welcome');
        },
        data(){
            return {

            }
        }
    }
</script>

<style scoped>
    .hero {
        background-image: url('/images/welcome-hero.png');
        background-size: 60%;
        background-color: #1d2633;
        background-blend-mode: multiply;
        background-position: right bottom;
        background-repeat: no-repeat;
        box-shadow: 0 20px 30px -16px rgba(30,20,16,0.6);
    }

    .hero p span {
        color: #f7c846;
    }
</style>
