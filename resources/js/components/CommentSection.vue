<template>
    <div class="mt-6 bg-white lg:w-4/12 flex flex-col justify-between">
        <div class="mx-6 mt-6 ">
            <div class="mb-6 flex justify-center  items-center">
                <img v-if="this.isLiked" @click="likeConfession(confession)" src="/public/icons/felt.png" class="mr-2 w-8 h-8 cursor-pointer" />
                <img v-if="!this.isLiked" @click="likeConfession(confession)" src="public/icons/feel.png" class="mr-2 w-8 h-8 cursor-pointer" />
                <span class="text-lg">{{ this.likeCount }} Feels</span>
            </div>
            <div class="h-135 overflow-y-scroll" id="comment-container">
                <comment-list :confession="confession"></comment-list>
            </div>
        </div>
        <div class="ml-6 mb-4">
            <form @submit.prevent="editMode ? updateComment() : postComment()">
                <input type="text" class="py-4 px-1 w-full border-t-2 border-dotted focus:outline-none" placeholder="Add a comment" v-model="text" />
                <div class="flex justify-end">
                    <button type="submit" class="px-6 mr-3 mt-2 mb-4 bg-blue-600 text-white rounded-full">
                        <span v-if="!editMode">Post</span>
                        <span v-if="editMode">Update</span>
                    </button>
                </div>
            </form>
        </div>
        <v-dialog />
    </div>
</template>
<script>
import CommentList from './CommentList'
export default {
    components: {
        CommentList
    },

    props: ['confession'],

    data() {
        return {
            id: '',
            text: '',
            isLiked: '',
            likeCount: '',
            editMode: false,
        }
    },

    methods: {
        postComment() {
            axios.post('/comment-confession', {
                    confessionId: this.confession.id,
                    text: this.text
                })
                .then(() => {
                    this.text = ''
                    Fire.$emit('ConfessionCommented')
                })
        },

        editComment(comment) {
            this.isOpen = false
            this.text = comment.content
            console.log(comment.content)
            Fire.$emit('EditComment', comment)
        },

        updateComment() {
            axios.patch(`/comments/${this.id}/edit`, {
                    text: this.text,
                })
                .then(() => {
                    this.text = ''
                    Fire.$emit('ConfessionCommented')
                    this.editMode = false
                })
        },

        likeConfession(confession) {
            this.toggleLikeCount();
            axios.post('/like-confession', {
                    id: confession.id
                })
                .then(({ data }) => {
                    //
                })
                .catch(() => {
                    //
                })
        },

        toggleLikeCount() {
            if (this.isLiked) {
                this.likeCount--
                this.isLiked = false
            } else {
                this.likeCount++
                this.isLiked = true
            }
        },
    },

    created() {
        this.isLiked = this.confession.is_liked
        this.likeCount = this.confession.like_count

        Fire.$on('EditComment', (comment) => {
            this.text = comment.content
            this.editMode = true
            this.id = comment.id
        })

        Fire.$on('ShowOption', () => {
            alert('hi')
            $('#comment-container').animate({
                scrollTop: $(this).offset().top + $(this).height() / 2
            }, 1000);
            // if (document.getElementById('comment-container').scrollTop >= 20) {
            //     document.getElementById('comment-container').scrollBy(0, 100);
            // }
        })
    }
}

</script>
