<template>
    <app-layout>
        <template #header>
            <div class="flex justify-end controls mb-3">
                <inertia-link class="uppercase text-white bg-blue-600 text-center rounded-lg w-4/12 py-2 px-3" :href=" route('registry.index') ">
                    <span class="fad fa-user-plus"></span>
                    registry index
                </inertia-link>
            </div>
            <ul>
                <li class="flex flex-col tile justify-center rounded-xl shadow-xl">
                    <h2> {{ registry.company_name }}  </h2>
                    <p> {{ registry.address, registry.postcode }} </p>
                    <p> {{ registry.city, registry.district, registry.region }} </p>
                    <p> {{ registry.email }} </p>
                    <div class="flex justify-end controls mt-3">
                        <inertia-link class="uppercase text-white bg-green-600 text-center rounded-lg w-4/12 py-2 px-3" :href=" route('registry.edit', {registry: registry.id}) ">
                            <span class="fad fa-user-edit"></span>
                        </inertia-link>

                        <form @submit.prevent="submit(registry.id)" class="text-white bg-red-600 text-center w-4/12 rounded-lg py-2 px-3 ml-2" method="post">
                            <button class="uppercase" type="submit">
                                <span class="fad fa-user-times"></span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            registry: Object,
            errors: Object,
        },
        mounted(){
            console.log('Registry Show');
        },
        methods: {
            submit(registry_id) {
                this.$inertia.delete('/registry/' + registry_id);
            },
        }
    }
</script>

<style>

    .tile {
        padding: 20px;
        height: 200px;
        width: calc((100% / 4) - 30px);
        border: 30px;
        margin: 0 15px 30px 15px;
    }

    .registries-move {
        transition: transform 2s;
    }

</style>
