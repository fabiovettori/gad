<template>
    <div>
        <p class="flex justify-between items-center w-3/5 m-auto bg-purple-500 rounded text-lg text-white mb-3 p-3" v-show="errorsCounter == 1 && alertStatus">
            There is one form error
            <span @click="$emit('status', false)" class="far fa-times-circle text-white cursor-pointer"></span>
        </p>
        <p class="flex justify-between items-center w-3/5 m-auto bg-purple-500 rounded text-lg text-white mb-3 p-3" v-show="errorsCounter > 1 && alertStatus">
            There are {{ errorsCounter }} form errors
            <span @click="$emit('status', false)" class="far fa-times-circle text-white cursor-pointer"></span>
        </p>

        <div class="w-3/5 m-auto bg-gray-800 rounded-2xl px-3 py-7 flex items-start">

            <img class="h-full w-7/12 mr-3 rounded-lg" :src="`https://eu.ui-avatars.com/api/?name=${$page.props.user.name}+${$page.props.user.last_name}&background=8b61f7&color=ffffff&format=svg`" alt="avatar">

            <form @submit.prevent="$emit('submit')" class="registry-form flex justify-end flex-wrap" method="post">
                <div class="w-full mb-2">
                    <label for="name" class="text-white font-semibold capitalize">name:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.name ? 'border-red-500' : ''" type="text" name="name" v-model=" form.name " placeholder="company name" minlength="2" maxlength="150" required>
                    <span v-show="errors.name" class="text-red-400">{{ errors.name }}</span>
                </div>

                <div class="w-2/4 pr-1 mb-2">
                    <label for="last_name" class="text-white font-semibold capitalize">last name:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.last_name ? 'border-red-500' : ''" type="text" name="last_name" v-model=" form.last_name " placeholder="last_name" minlength="5" maxlength="255" required>
                    <span v-show="errors.last_name" class="text-red-400">{{ errors.last_name }}</span>
                </div>

                <div class="w-2/4 pl-1 mb-2">
                    <label for="email" class="text-white font-semibold capitalize">email:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.email ? 'border-red-500' : ''" type="text" name="email" v-model=" form.email " placeholder="email" minlength="5" maxlength="5" required>
                    <span v-show="errors.email" class="text-red-400">{{ errors.email }}</span>
                </div>

                <div class="w-full pl-1 mb-2 flex flex-col items-start justify-">
                    <span class="text-white font-semibold capitalize">permissions:</span>
                    <div class="flex justify-start">
                        <div v-for="permission in permissions" class="flex justify-center items-center bg-gray-800 rounded-lg py-2 mr-5 w-18">
                            <input class="mr-2 w-6 h-6" :class="errors.email ? 'border-red-500' : ''" type="checkbox" name="permissions[]" :value="permission.id" :checked="userPermissions[0].id == permission.id ? true : false">
                            <label :for="permission.name" class="text-sm font-bold uppercase text-white"> {{ permission.name }} </label>
                            <!-- <span v-show="errors.email" class="text-red-400">{{ errors.email }}</span> -->
                        </div>
                    </div>
                </div>

                <div class="flex justify-end controls mt-3">
                    <button class="uppercase text-xs font-bold uppercase text-white bg-purple-500 text-center rounded-lg py-2 px-3 focus:outline-none" type="submit" :disabled="form.processing">{{ formName }} user
                        <span class="text-white fas fa-plus"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        formName: String,
        errors: Object,
        form: Object,
        permissions: Object,
        userPermissions: Object,
        alertStatus: Boolean,
    },
    computed: {
        errorsCounter(){
            return Object.keys(this.errors).length;
        }
    },
    data(){
        return {
            permissionsChecked: [],
        }
    }
}
</script>

<style scoped>

    input::placeholder {
        text-transform: capitalize;
    }

</style>
