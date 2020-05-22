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
        getCategoryConfessions() {
            axios.get(`/category/${this.id}/confessions`)
                .then(({ data }) => {
                    this.confessions = data
                })
        }
    },

    created() {
        this.getCategoryConfessions()

        Fire.$on('updated', () => {
            this.getCategoryConfessions()
        })
    }
}

</script>
