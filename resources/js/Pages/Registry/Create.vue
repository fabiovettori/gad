<template>
    <app-layout :scrollable="false" :title="'Create Registry'" :contentStyle="'height: calc(100vh - 70px); display: flex; align-items: center; background-image: url(/images/bg-crud-mod.png); background-repeat: no-repeat; background-position: bottom left; background-size: cover'">

        <template #header>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Create Registry
            </h2>
        </template>

        <template #default>
            <div>

                <h2 class="w-3/5 m-auto text-4xl font-black mb-7">
                    <inertia-link class="text-purple-500" :href="route('registry.index')">Registry</inertia-link>
                    <span> / Create</span>
                </h2>

                <form-registry :formName="'create'" :errors="errors" :form="form" @submit="store" :alertStatus="alertStatus" @status="alertStatus = false"/>

            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormRegistry from '@/Partials/FormRegistry'

    export default {
        components: {
            AppLayout,
            FormRegistry,
        },
        props: {
            errors: Object,
        },
        mounted(){
            console.log('Registry Create');
        },
        data(){
            return {
                form: {
                    company_name: null,
                    address: null,
                    postcode: null,
                    city: null,
                    district: null,
                    region: null,
                    email: null,
                },
                alertStatus: true,
            }
        },
        methods: {
            store() {
                let self = this;
                this.$inertia.post('/registry/', this.form, {
                    onError: function(){
                        self.alertStatus = true;
                    }
                });
            },
        }
    }
</script>
