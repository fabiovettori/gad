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

        <div class="w-3/5 m-auto bg-gray-800 rounded-2xl px-3 py-7">
            <form @submit.prevent="$emit('submit')" class="registry-form flex justify-end flex-wrap" method="post">
                <div class="w-full mb-2">
                    <label for="company_name" class="text-white font-semibold capitalize">company name:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.company_name ? 'border-red-500' : ''" type="text" name="company_name" v-model=" form.company_name " placeholder="company name" minlength="2" maxlength="150" required>
                    <span v-show="errors.company_name" class="text-red-400">{{ errors.company_name }}</span>
                </div>

                <div class="w-2/4 pr-1 mb-2">
                    <label for="address" class="text-white font-semibold capitalize">address:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.address ? 'border-red-500' : ''" type="text" name="address" v-model=" form.address " placeholder="address" minlength="5" maxlength="255" required>
                    <span v-show="errors.address" class="text-red-400">{{ errors.address }}</span>
                </div>

                <div class="w-2/4 pl-1 mb-2">
                    <label for="postcode" class="text-white font-semibold capitalize">postcode:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.postcode ? 'border-red-500' : ''" type="text" name="postcode" v-model=" form.postcode " placeholder="postcode" minlength="5" maxlength="5" required>
                    <span v-show="errors.postcode" class="text-red-400">{{ errors.postcode }}</span>
                </div>

                <div class="w-2/4 pr-1 mb-2">
                    <label for="city" class="text-white font-semibold capitalize">city:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.city ? 'border-red-500' : ''" type="text" name="city" v-model=" form.city " placeholder="city" minlength="2" maxlength="50" required>
                    <span v-show="errors.city" class="text-red-400">{{ errors.city }}</span>
                </div>

                <div class="w-2/4 pl-1 mb-2">
                    <label for="district" class="text-white font-semibold capitalize">district:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.district ? 'border-red-500' : ''" type="text" name="district" v-model=" form.district " placeholder="district" minlength="2" maxlength="150" required>
                    <span v-show="errors.district" class="text-red-400">{{ errors.district }}</span>
                </div>

                <div class="w-2/4 pr-1 mb-2">
                    <label for="region" class="text-white font-semibold capitalize">region:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.region ? 'border-red-500' : ''" type="text" name="region" v-model=" form.region " placeholder="region" minlength="2" maxlength="150" required>
                    <span v-show="errors.region" class="text-red-400">{{ errors.region }}</span>
                </div>

                <div class="w-2/4 pl-1 mb-2">
                    <label for="email" class="text-white font-semibold capitalize">email:</label>
                    <input class="w-full h-12 rounded border-gray-300 focus:border-purple-500 my-1" :class="errors.email ? 'border-red-500' : ''" type="email" name="email" v-model=" form.email " placeholder="email" minlength="2" maxlength="150" required>
                    <span v-show="errors.email" class="text-red-400">{{ errors.email }}</span>
                </div>

                <div class="flex justify-end controls mt-3">
                    <button class="uppercase text-xs font-bold uppercase text-white bg-purple-500 text-center rounded-lg py-2 px-3 focus:outline-none" type="submit" :disabled="form.processing">{{ formName }} registry
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
        alertStatus: Boolean,
    },
    computed: {
        errorsCounter(){
            return Object.keys(this.errors).length;
        }
    },
}
</script>

<style scoped>

    input::placeholder {
        text-transform: capitalize;
    }

</style>
