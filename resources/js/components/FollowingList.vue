<template>
    <div class="flex flex-wrap">
        <following v-for="following in followings" :person="following" :key="following.id"></following>
    </div>
</template>
<script>
import Following from './Following';
export default {
    components: {
        Following,
    },

    computed: {
        followings() {
            return this.$store.state.followings;
        }
    }

}

</script>
