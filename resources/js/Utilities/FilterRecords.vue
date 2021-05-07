<template>
    <div>
        <select class="bg-white rounded-l-lg px-3 py-2 border-none shadow capitalize pr-10 focus:ring-transparent cursor-pointer" @change="changeFilter($event)">
            <option class="disabled text-gray-500" value="">Filter</option>
            <option class="hover:cursor-pointer" v-for="(header, index) in tableHeader" :value="header.split(' ').join('_')"> {{ header }} </option>
        </select>
        <input v-model="userSearch" @input="$emit('userSearch', $event.target.value)" class="bg-white rounded-r-lg px-3 py-2 border-none shadow focus:ring-transparent" type="text" placeholder="Search..." :disabled=disabled>
        <button @click="reset" class="capitalize ml-3 hover:cursor-pointer focus:outline-none">reset</button>
    </div>
</template>

<script>
export default {
    props: {
        tableHeader: Array,
        disabled: Boolean,
    },
    mounted(){
        console.log('Filter Records');
    },
    data(){
        return {
            userSearch: '',
        }
    },
    methods: {
        reset(){
            this.userSearch = '';
            this.$emit('reset');
        },
        changeFilter(evt){
            this.$emit('tableHeaderActive',  evt.target.value);

            if (evt.target.value == '') {
                this.userSearch = '';
            }
        }
    }
}
</script>
