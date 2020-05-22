<template>
    <div class="mt-2">
        <div>
            <div class="border-b">
                <div class="flex justify-between items-center">
                    <div class="flex">
                        <img :src="comment.user.profile_picture" class="w-6 h-6 rounded-full">
                        <a :href="'/user/' + comment.user.username">
                            <h3 class="font-bold ml-1">{{ comment.user.username }}</h3>
                        </a>
                    </div>
                    <div>
                        <i v-if="$gate.canEdit(comment)" @click.prevent="editComment(comment)" class="fa fa-pencil text-green-500 mr-2 pull-right cursor-pointer"></i>
                        <i v-if="$gate.canDelete(comment)" @click.prevent="deleteComment(comment)" class="fa fa-trash text-red-500 mr-2 pull-right cursor-pointer"></i>
                    </div>
                    <!-- <i class="fa fa-ellipsis-h mr-2"></i> -->
                    <!-- <div class="relative" v-if="$gate.canDelete(comment)">
                        <i @click="showOption()" class="fa fa-ellipsis-h mr-2 cursor-pointer"></i>
                        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-black opacity-50 cursor-default"></button>
                        <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-32 bg-white rounded-lg shadow-xl z-10">
                            <a @click.prevent="editComment(comment)" href="#" class="block px-2 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Edit</a>
                            <a @click.prevent="deleteComment(comment)" href="#" class="block px-2 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Delete</a>
                        </div>
                    </div> -->
                </div>
                <input v-if="comment.id == id && editMode" @keyup.enter="updateComment()" type="text" class="border w-full mt-1" v-model="text">
                <h4 v-else class="mb-4 text-gray-600 text-sm">{{ comment.content }}</h4>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-600">
                    {{ comment.created_at }}
                </div>
                <div class="flex">
                    <span class="mr-2 text-xs">{{ comment.like_count }}</span>
                    <div @click.prevent="likeComment(comment)" class="cursor-pointer">
                        <img v-if="comment.is_liked" src="/public/icons/felt.png" class="mr-4 w-6 h-6" />
                        <img v-else src="/public/icons/feel.png" class="mr-4 w-6 h-6" />
                    </div>
                    <a @click.prevent="showReplyForm(comment)" class="mr-3 text-gray-700 text-sm cursor-pointer">Reply</a>
                </div>
            </div>
            <div v-if="replyingToComment == comment">
                <form @submit.prevent="addReply(comment)">
                    <input type="text" class="w-full border my-1" v-model="text">
                    <div class="flex justify-between">
                        <button type="submit" class="px-6 mb-2 bg-blue-600 text-white rounded-full">Reply</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="ml-8" v-if="comment.childrens">
            <comment-replies :replies="comment.childrens"></comment-replies>
        </div>
    </div>
</template>
<script>
import CommentReplies from './CommentReplies'
export default {
    props: ['comment'],

    components: {
        CommentReplies
    },

    data() {
        return {
            id: '',
            text: '',
            replyingToComment: '',
            isOpen: false,
            editMode: false
        }
    },

    methods: {
        addReply(comment) {
            axios.post('/comment-confession', {
                    confessionId: comment.confession_id,
                    text: this.text,
                    parentId: comment.id
                })
                .then(() => {
                    Fire.$emit('ConfessionCommented')
                })
        },

        showReplyForm(comment) {
            if (this.replyingToComment == '') {
                this.replyingToComment = comment
            } else {
                this.replyingToComment = ''
            }
        },

        editComment(comment) {
            if (this.editMode) {
                this.editMode = false
                this.id = ''
                this.text = ''
            } else {
                this.editMode = true
                this.id = comment.id
                this.text = comment.content
            }
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

        deleteComment(comment) {
            console.log('clicked')
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure you want to delete?',
                buttons: [{
                        title: 'Yes',
                        handler: () => {
                            axios.delete(`/comments/${comment.id}`)
                                .then(() => {
                                    this.$modal.hide('dialog')
                                    Vue.$toast.open('Comment deleted successfully')
                                    Fire.$emit('ConfessionDeleted')
                                })
                                .catch(() => {
                                    this.$modal.hide('dialog')
                                    Vue.$toast.error('Unauthorized!')
                                })
                        }
                    },
                    {
                        title: '', // Button title
                        default: true, // Will be triggered by default if 'Enter' pressed.
                        handler: () => {} // Button click handler
                    },
                    {
                        title: 'Close'
                    }
                ]
            })
        },

        likeComment(comment) {
            axios.post('/like-comment', {
                    id: comment.id
                })
                .then(() => {
                    console.log('done')
                    Fire.$emit('ConfessionCommented')
                })
        },

        showOption() {
            this.isOpen = !this.isOpen
            Fire.$emit('ShowOption')
        }
    }
}

</script>
