<template>
    <app-layout :scrollable="false" :title="'Edit Registry'" :contentStyle="'height: calc(100vh - 70px); display: flex; align-items: center; background-image: url(/images/bg-crud-mod.png); background-repeat: no-repeat; background-position: bottom left; background-size: cover'">

        <template #header>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Edit Registry
            </h2>
        </template>

        <template #default>
            <div>
                <h2 class="w-3/5 m-auto text-4xl font-black mb-7">
                    <inertia-link class="text-purple-500" :href="route('registry.index')">Registry</inertia-link>
                    <span> / Edit</span>
                </h2>

                <form-registry :formName="'edit'" :errors="errors" :form="form" @submit="update" :alertStatus="alertStatus" @status="alertStatus = false"/>

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
            registry: Object,
            errors: Object,
        },
        mounted(){
            console.log('Registry Edit');
            this.existingValues();
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
            update() {
                let self = this;
                this.$inertia.put('/registry/' + this.registry.id, this.form, {
                    onError: function(){
                        self.alertStatus = true;
                    }
                });
            },
            existingValues() {
                this.form.company_name = this.registry.company_name;
                this.form.address = this.registry.address;
                this.form.postcode = this.registry.postcode;
                this.form.city = this.registry.city;
                this.form.district = this.registry.district;
                this.form.region = this.registry.region;
                this.form.email = this.registry.email;
            }
        }
    }
</script>

<style scoped>

    input::placeholder {
        text-transform: capitalize;
    }

</style>
