<template>
    <div v-if="comment.childrens">
        <div v-for="(comment,index) in comment.childrens">
            <div>
                <small class="font-bold">{{ comment.user.username }}</small>
                <div>{{ comment.content }}</div>
                <div class="d-flex justify-content-end mt-2">
                    <a href="#" @click.prevent="showReplyForm(comment)" class="">Reply</a>
                </div>
                <div v-if="comment == reply_comment && show_reply_form == true">
                    <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                    <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                </div>
            </div>
            <recursive-comment :comment="comment"></recursive-comment>
        </div>
    </div>
</template>
<script>
export default {
    props: ['comment'],

    data() {
        return {
            reply_comment: {},
            show_reply_form: false,
            reply_content: '',
            content: '',
            feed: new Form({
                comments: {},
            }),
        }
    },

    methods: {
        showReplyForm(comment) {
            this.reply_comment = comment;
            if (this.show_reply_form == true) {
                this.show_reply_form = false;
            } else {
                this.show_reply_form = true;
            }
            this.reply_content = '';
        },

        getCommentsBasedOnFeedId(feedId) {
            axios.get('/confessions/' + feedId + '/comments')
                .then(({ data }) => {
                    this.feed.comments = data;
                })
        },

        replyTo(comment) {
            axios.post('/feeds/comment', { content: this.reply_content, feed_id: comment.feed_id, parent_id: comment.id })
                .then(response => {
                    this.content = '';
                    if (!response.data.error) {
                        this.content = '';
                        let payLoad = {
                            post_id: comment.post_id,
                            comments: response.data.data
                        };
                        // this.getCommentsBasedOnFeedId(comment.feed_id);
                        this.show_reply_form = false;
                        Fire.$emit('CommentUpdated', comment.feed_id);
                        // this.$store.commit('updateComments',payLoad);
                    }
                });
        },
    }
};

</script>
