<template>
    <div>
        <div class="mt-6 mb-8 bg-white border rounded-lg shadow">
            <div class="flex justify-between p-4">
                <div class="flex">
                    <div>
                        <a :href="'/user/' + confession.user.username">
                            <img src="/public/images/profile.jpg" class="h-10 w-10 mr-2 rounded-full" />
                        </a>
                    </div>
                    <div>
                        <div class="flex">
                            <a :href="'/user/' + confession.user.username" class="text-teal-600 font-bold mr-1">{{ confession.user.username }}</a>
                        </div>
                        <div v-if="$gate.userId() != confession.user.id">
                            <button @click.prevent="followUser(confession)" class="px-6 text-sm text-white bg-yellow-600 rounded" v-if="!confession.user.is_following">Follow</button>
                            <button @click.prevent="followUser(confession)" class="px-6 text-sm text-white bg-gray-600 rounded" v-if="confession.user.is_following">Unfollow</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div @click.prevent="showOptions(confession.id, confession.user_id)" class="cursor-pointer">
                        <i class="fa fa-ellipsis-h mr-5 text-gray-600 "></i>
                    </div>
                </div>
            </div>
            <div class="h-135 w-full -z-10 flex justify-center items-center bg-blue-900 bg-cover bg-center" :style="{'background-image': `url(${confession.background.image})`}">
                <p class="px-4 text-xl font-extrabold" style="font-family: HelveticaNeue;">
                    {{ confession.text.substring(0, 600) }}
                    <a v-if="confession.text.length >= 600" href="#" @click.prevent="showConfessionDetailModal(confession)" class="text-sm">Read More</a>
                </p>
            </div>
            <div class="mt-2 text-sm ml-4 lg:flex lg:justify-end">
                <span class="mr-2 text-gray-600">Posted {{ confession.created_at }} on</span>
                <a :href="`/category/${confession.category.slug}`" class="mr-4 text-teal-600 font-bold">{{ confession.category.name }}</a>
            </div>
            <div class="ml-4 pb-2 flex">
                <div class="flex flex-col items-center cursor-pointer">
                    <span>{{ confession.like_count }}</span>
                    <img v-if="!confession.is_liked" @click.prevent="likeConfession(confession)" src="/public/icons/feel.png" class="w-6 h-6" />
                    <img v-if="confession.is_liked" @click.prevent="likeConfession(confession)" src="/public/icons/felt.png" class="w-6 h-6" />
                </div>
                <div @click.prevent="showConfessionDetailModal(confession)" class="mx-4 flex flex-col items-center cursor-pointer">
                    <span>{{ confession.comment_count }}</span>
                    <img src="/public/icons/comment.png" class="w-6 h-6" />
                </div>
                <div class="flex flex-col justify-end cursor-pointer">
                    <img src="/public/icons/share.png" class="w-6 h-6" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ConfessionOptionModal from './ConfessionOptionModal'
import ConfessionDetailModal from './ConfessionDetailModal'
import LoginAlertModel from './LoginAlertModel'
export default {
    props: ['confession'],

    methods: {
        likeConfession(confession) {
            if (window.user == undefined) {
                this.showLoginAlertModel()
                return
            }
            this.toggleLikeCount(confession);
            axios.post('/like-confession', {
                    id: confession.id
                })
                .then(({ data }) => {
                    if (data.success.attached != '') {
                        confession.is_liked = true;
                    } else {
                        confession.is_liked = false;
                    }
                })
                .catch(() => {
                    //
                })
        },

        toggleLikeCount(confession) {
            if (confession.is_liked) {
                confession.like_count--;
                confession.is_liked = false;
            } else {
                confession.like_count++;
                confession.is_liked = true;
            }
        },

        followUser(confession) {
            if (window.user == undefined) {
                this.showLoginAlertModel()
                return
            }
            if (confession.user.is_following) {
                confession.user.is_following = false;
            } else {
                confession.user.is_following = true;
            }
            axios.post('/follow-user', {
                    id: confession.user.id
                })
                .then(() => {
                    const activeMenu = this.$store.state.activeMenu
                    if (activeMenu == 'trending') {
                        this.$store.dispatch('getTrendingConfessions')
                    } else if (activeMenu == 'latest') {
                        this.$store.dispatch('getLatestConfessions')
                    } else {
                        this.$store.dispatch('getFollowingPeopleConfessions')
                    }
                    Fire.$emit('updated')
                })
        },

        showOptions(id, userId) {
            this.$modal.show(ConfessionOptionModal, {
                id: id,
                userId: userId,
                page: 'index',
            }, {
                width: 250,
                height: 'auto'
            })
        },

        showLoginAlertModel() {
            this.$modal.show(LoginAlertModel, {
                width: 250,
                height: 'auto'
            })
        },

        showConfessionDetailModal(confession) {
            if (window.user == undefined) {
                this.showLoginAlertModel()
                return
            }
            history.pushState({ foo: "bar" }, "page 2", `/confessions/${confession.id}`);
            this.$modal.show(ConfessionDetailModal, {
                confession: confession,
            }, {
                width: '80%',
                height: 'auto',
                scrollable: true
            })
        },

        isAuthenticated() {
            if (window.user == undefined) {
                this.showLoginAlertModel()
                return
            }
        }
    },

    created() {
        Fire.$on('FollowUser', (confession) => {
            alert('ok')
            this.followUser(confession)
        })
    }
}

</script>
<style>
</style>
