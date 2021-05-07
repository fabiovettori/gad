<template>
    <teleport to="head">
        <title>GAD | Error {{ title }}</title>
    </teleport>

    <div class="flex items-center h-screen">
        <div class="flex flex-col justify-center items-start px-12">
            <h1 class="text-5xl text-purple-500 font-bold">{{ title }}.</h1>
            <p class="text-8xl mt-3 mb-8 relative description" v-html="description"></p>
            <p class="text-4xl font-semibold mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, maxime delectus sapiente possimus!</p>
            <inertia-link :href="route('welcome')" class="py-3 px-5 rounded-lg bg-black text-white text-2xl tracking-wide">Go home</inertia-link>
        </div>
        <img class="h-4/5" src="/images/error.png" alt="gad error page">
    </div>
</template>

<script>
export default {
  props: {
    status: Number,
  },
  computed: {
    title() {
      return {
        503: '503',
        500: '500',
        404: '404',
        403: '403',
      }[this.status]
    },
    description() {
      return {
        503: 'Sorry, we are doing some maintenance. <br> Please check back soon.',
        500: 'Whoops, <br> something went wrong.',
        404: 'Something <br> gone missing...',
        403: 'Sorry, you are forbidden <br> from accessing this page.',
      }[this.status]
    },
  },
}
</script>

<style scoped>
    .description:after {
        content: '';
        position: absolute;
        z-index: -1;
        background-image: url('/images/error-marker.png');
        background-size: cover;
        width: 35%;
        height: 20px;
        left: 0;
        bottom: -10px;
    }
</style>
