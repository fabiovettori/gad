<template>
    <app-layout :scrollable="false" :title="'User Permissions'" :contentStyle="'height: calc(100vh - 70px); display: flex; align-items: center; background-image: url(/images/bg-crud-mod.png); background-repeat: no-repeat; background-position: bottom left; background-size: cover'">

        <template #header>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                User Permissions
            </h2>
        </template>

        <template #default>
            <div>
                <h2 class="w-3/5 m-auto text-4xl font-black mb-7">
                    <inertia-link class="text-purple-500" :href="route('permissions')">Permissions</inertia-link>
                    <span> / Edit</span>
                </h2>

                <form-user :formName="'edit'" :errors="errors" :form="form" :permissions="permissions" :userPermissions="user.permissions" @submit="update" :alertStatus="alertStatus" @status="alertStatus = false"/>

            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormUser from '@/Partials/FormUser'

    export default {
        components: {
            AppLayout,
            FormUser,
        },
        props: {
            user: Object,
            permissions: Object,
            errors: Object,
        },
        mounted(){
            console.log('Edit User Permissions');
            this.existingValues();
        },
        data(){
            return {
                form: {
                    name: null,
                    last_name: null,
                    email: null,
                    permissions: [],
                },
                alertStatus: true,
            }
        },
        methods: {
            update() {
                console.log(this.form);
                let self = this;
                this.$inertia.put('/user/' + this.user.id, this.form, {
                    onError: function(){
                        self.alertStatus = true;
                    }
                });
            },
            existingValues() {
                this.form.name = this.user.name;
                this.form.last_name = this.user.last_name;
                this.form.email = this.user.email;
                // this.form.permissions = this.user.permissions[0].id;
            }
        }
    }
</script>

<style scoped>

    input::placeholder {
        text-transform: capitalize;
    }

</style>
