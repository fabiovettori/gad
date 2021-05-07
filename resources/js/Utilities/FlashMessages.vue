<template>
    <div>
        <div v-if="status">
            <p class="flex justify-between items-center mx-2 my-2 p-3 bg-purple-500 rounded cursor-pointer text-lg text-white">
                <span> {{ $page.props.flash.success }} </span>
                <span @click="$page.props.flash.success = null" class="far fa-times-circle text-white"></span>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        success(){
            return this.$page.props.flash.success;
        },
        status(){
            if (this.success != null) {
                this.$emit('flashActive');
                return true;
            } else {
                this.$emit('flashClose');
                return false;
            }
        }
    }
}
</script>
