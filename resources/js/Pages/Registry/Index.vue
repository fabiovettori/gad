<template>
    <app-layout class="relative" :scrollable="true" :title="'Registry'" :contentStyle="flashMessage ? 'height:calc(100vh - 70px - 56px - 68px);' : 'height:calc(100vh - 70px - 56px);'" @flashActive="flashMessage = true" @flashClose="flashMessage = false">

        <template #header>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Registry
                <span class="text-sm font-light">[records: {{ registries.length }}]</span>
            </h2>
        </template>

        <template #controls-bar>
            <div class="flex justify-between controls relative">

                <filter-records :tableHeader="tableHeader" @userSearch="search" @reset="searchQuery = ''" @tableHeaderActive="tableHeaderActive" :disabled="filterStatus"/>

                <div class="flex justify-end">
                    <inertia-link v-show="$page.props.user.permissions[0].id == 1 || $page.props.user.permissions[0].id == 2"
                    class="flex items-center text-xs font-bold uppercase text-white bg-gray-800 text-center rounded-lg py-2 px-3" :href=" route('registry.create') ">
                        new entry
                        <span class="fad fa-user-plus text-sm pl-1"></span>
                    </inertia-link>
                    <a class="flex items-center text-xs font-bold uppercase text-white bg-gray-800 text-center rounded-lg py-2 px-3 mx-1" :href=" route('registry.export') ">
                        Download
                        <span class="fad fa-cloud-download text-base pl-1"></span>
                    </a>
                    <form @submit.prevent="submitUser" class="flex items-center text-xs font-bold uppercase text-white bg-gray-800 text-center rounded-lg py-2 px-3" method="post" enctype="multipart/form-data" v-show="$page.props.flash.permission">
                        <input type="file" name="registry_db" @input="form.registry_db = $event.target.files[0]">
                        <button class="font-bold uppercase text-white uppercase focus:outline-none" type="submit" :disabled="form.processing">
                            Upload
                            <span class="fad fa-cloud-upload text-base pl-1"></span>
                        </button>
                    </form>
                </div>
            </div>

            <transition name="close-dialog-box">
                <div v-if="closeModal.status" class="close_modal flex justify-between items-center absolute bg-white right-0 bottom-0 z-20 p-5">
                    <h2>Do you want to delete this record?</h2>
                    <div class="flex">
                        <form @submit.prevent="deleteItem(closeModal.id)" method="post">
                            <button class="text-xs font-bold uppercase text-white hover:text-red-400 bg-gray-800 text-center rounded-lg py-2 px-3 focus:outline-none" type="submit">conferm</button>
                        </form>
                        <button @click="closeModal.status = false" class="text-xs font-bold uppercase text-white hover:text-green-400 bg-gray-800 text-center rounded-lg py-2 px-3 ml-1 focus:outline-none" type="button">discard</button>
                    </div>
                </div>
            </transition>
        </template>

        <template #default>
            <table class="table-fixed registries">
                <thead class="bg-gray-500">
                    <tr class="h-14 py-3 rounded">
                        <th class="capitalize w-20 text-center text-white rounded-l">actions</th>
                        <th class="text-center w-12 text-white"> # </th>
                        <th v-for="(title, index) in tableHeader" class="capitalize w-60 h-10 text-left text-white" :class="index == tableHeader.length - 1 ? 'rounded-r' : ''">
                            {{ title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <transition-group
                        name="records">
                        <tr v-for="(registry, index) in registries" :key="registry.id" v-show="filter(registry)" class="h-14 py-5 border border-gray-300 bg-white hover:bg-gray-100">
                            <td class="relative flex items-center justify-evenly h-14 w-20">
                                <button @click="deleteMe(registry.id)" class="uppercase focus:outline-none" type="button">
                                    <span class="relative far fa-times-circle hover:text-purple-500"></span>
                                </button>

                                <inertia-link class="focus:outline-none" :href=" route('registry.edit', {registry: registry.id}) ">
                                    <span class="relative fas fa-pen hover:text-purple-500"></span>
                                </inertia-link>
                            </td>
                            <td class="text-center w-12 px-2"> {{ index + 1 }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.company_name }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.email }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.address }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.postcode }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.city }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.district }} </td>
                            <td class="w-60 break-words px-2"> {{ registry.region }} </td>
                        </tr>
                    </transition-group>
                </tbody>
            </table>
        </template>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FilterRecords from '@/Utilities/FilterRecords'

    export default {
        components: {
            AppLayout,
            FilterRecords,
        },
        props: {
            registries: Array,
            errors: Object,
        },
        mounted(){
            console.log('Registry Index');
        },
        computed: {
            filterStatus(){
                return this.queryParam == '' ? true : false;
            },
        },
        data(){
            return {
                tableHeader: ['company name', 'email', 'address', 'postcode', 'city', 'district', 'region'],
                form: this.$inertia.form({
                    registry_db: null,
                }),
                closeModal: {
                    status: false,
                    id: null,
                },
                flashMessage: false,
                queryParam: '',
                searchQuery: '',
            }
        },
        methods: {
            submitUser() {
                if (this.form.registry_db != null) {
                    this.form.post('/registry-import');
                }
            },
            deleteMe(index){
                this.closeModal.id = index;
                this.closeModal.status = true;
            },
            deleteItem(){
                this.$inertia.delete('/registry/' + this.closeModal.id);

                this.closeModal.status = false;
                this.closeModal.id = null;
            },
            search(queryString){
                this.searchQuery = queryString;
            },
            tableHeaderActive(value){
                this.queryParam = value;
            },
            filter(registry){
                if (this.queryParam === '') {
                    return true;
                } else if (registry[this.queryParam].toString().toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    return true;
                }
            }
        }
    }
</script>

<style>

    .registries {
        width: 1400px;
    }

    .controls a:hover span, .controls button:hover span {
        color: rgba(52, 211, 153, var(--tw-text-opacity));
    }

    .fa-times-circle:hover:after, .fa-pen:hover:after {
        opacity: 1;
    }

    .fa-times-circle:after {
        content: 'delete';
    }

    .fa-pen:after {
        content: 'edit';
    }

    .fa-times-circle:after, .fa-pen:after {
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        background-color: #1f2937;
        color: white !important;
        text-transform: uppercase;
        font-size: 0.75rem;
        line-height: 1rem;
        letter-spacing: .9px;
        font-weight: 900;
        font-family: 'Nunito', 'Arial';
        padding: 5px 10px;
        color: black;
        position: absolute;
        display: block;
        text-align: center;
        width: 70px;
        top: 0;
        right: 0;
        transform: translate(75%, -150%);
        opacity: 0;
        transition: opacity .3s ease;
        border-radius: 5px;
    }

    .close_modal {
        width: 500px;
        border-radius: 0 0 0 20px;
        box-shadow: 0 20px 30px -16px rgba(9,9,16,0.2);
        transform-origin: top;
        transform: translateY(100%) rotateX(0deg);
        opacity: 1;
    }

    .close-dialog-box-enter-active {
        animation: closeEnterModal 1s ease forwards;
    }

    .close-dialog-box-leave-active {
        animation: closeLeaveModal 1s ease forwards;
    }

    @keyframes closeEnterModal {
        0% {
            transform: translateY(100%) rotateX(90deg);
            opacity: 0;
        }
        100% {
            transform: translateY(100%) rotateX(0deg);
            opacity: 1;
        }
    }

    @keyframes closeLeaveModal {
        0% {
            transform: translateY(100%) rotateX(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100%) rotateX(90deg);
            opacity: 0;
        }
    }

    .records-enter, .records-leave-to {
        opacity: 0;
    }

    .records-enter-active {
        opacity: 0;
        transition: all 1.2s ease;
    }

    .records-enter-to, .records-leave {
        opacity: 1;
    }

    .records-leave-active {
        opacity: 1;
        transition: all 1.2s ease;
    }
</style>
