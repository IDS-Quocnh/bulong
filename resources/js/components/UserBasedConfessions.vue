<template>
    <div>
        <confession v-for="confession in confessions" :confession="confession" :key="confession.id"></confession>
    </div>
</template>
<script>
import Confession from './Confession'
export default {
    components: {
        Confession
    },

    props: ['id'],

    data() {
        return {
            confessions: ''
        }
    },

    methods: {
        getUserConfessions() {
            axios.get(`/${this.id}/confessions`)
                .then(({ data }) => {
                    this.confessions = data
                })
        }
    },

    mounted() {
        this.getUserConfessions()
    },

    created() {

        Fire.$on('updated', () => {
            this.getUserConfessions()
        })
    }
}

</script>
