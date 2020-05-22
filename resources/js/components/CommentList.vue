<template>
    <div>
        <comment v-for="comment in comments" :comment="comment" :key="comment.id"></comment>
    </div>
</template>
<script>
import Comment from './Comment'
export default {
    components: {
        Comment
    },

    props: ['confession'],

    data() {
        return {
            comments: ''
        }
    },

    methods: {
        getComments() {
            axios.get('/confessions/' + this.confession.id + '/comments')
                .then(({ data }) => {
                    this.comments = data
                })
        }
    },

    created() {
        this.getComments()

        Fire.$on('ConfessionCommented', () => {
            this.getComments()
        })

        Fire.$on('ConfessionDeleted', () => {
            this.getComments()
        })

    }
}

</script>
