<template>
    <div>
        <ul class="nav customtab nav-tabs" role="tablist">
            <li role="presentation" class="nav-item"><a href="#trending" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false" @click="getTrendingConfession()"><span class="visible-xs"><i class="icon icon-fire"></i></span> <span class="hidden-xs">Trending</span></a></li>
            <li role="presentation" class="nav-item"><a href="#latest" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true" @click="getLatestConfession()"><span class="visible-xs"><i class="icon icon-clock"></i></span><span class="hidden-xs"> Latest</span></a></li>
            <!-- <li role="presentation" class="nav-item"><a href="#most-felt" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false" @click="getMostFeltConfession()"><span class="visible-xs"><i class="ti-heart"></i></span> <span class="hidden-xs">Most Felt</span></a></li>
 -->
            <li role="presentation" class="nav-item"><a href="#following" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false" @click="getMostFeltConfession()"><span class="visible-xs"><i class="ti-people"></i></span> <span class="hidden-xs">People You Follow</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="latest">
                <div v-for="(feed, index) in latest_confessions">
                    <!-- <div v-if="[2, 6, 14].includes(index)"> -->
                    <div v-if="Math.random() <= 0.10">
                        <div style="background-color: orange;">
                            <a :href="advertisements[Math.floor(Math.random() * advertisements.length)].url" target="_blank">
                                <img :src="advertisements[Math.floor(Math.random() * advertisements.length)].image" alt="ads" width="550" height="200">
                            </a>
                        </div>
                    </div>
                    <div class="d-flex bg-white py-2 mt-4 mb-4">
                        <div class="d-flex flex-column align-items-center justify-content-center mx-2">
                            <img :src="feed.category.image" width="40" class="my-2">
                            <small>{{ feed.category.name }}</small>
                            <button v-if="!feed.user.is_following" class="btn btn-sm btn-primary mt-2" @click.prevent="followUser(feed.username)">Follow</button>
                            <button v-if="feed.user.is_following" class="btn btn-sm btn-danger mt-2" @click.prevent="unfollowUser(feed.username)">UnFollow</button>
                        </div>
                        <div class="d-flex flex-column justify-content-end my-1 ml-4">
                            <h4 class="mb-4">
                                <a href="#" @click.prevent="showFeed(feed)" class="text-gray-dark">{{ feed.text }}</a>
                            </h4>
                            <div class="d-flex justify-content-between">
                                <div>
                                    By <a :href="feed.username + '/' + 'confessions'" class="">@{{ feed.username }}</a><br>
                                    <small class="text-muted">{{ feed.created_at }}</small>
                                </div>
                                <div class="text-muted mx-2">
                                    <span class="mr-2"><i class="fa fa-heart"></i> {{ feed.like_count }} feels</span>
                                    <span><i class="fa fa-comment"></i> {{ feed.comment_count }} comments</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between border-top mt-2">
                                <div class="mt-2 cursor-pointer " @click.prevent="like(feed)">
                                    <span><i class="fa fa-heart" :class="{ 'text-danger' : feed.is_liked}"></i></span>
                                    <span v-if="feed.is_liked">Unfeels</span>
                                    <span v-if="!feed.is_liked">Feels</span>
                                </div>
                                <div class="mt-2 mr-2 cursor-pointer" @click.prevent="showFeed(feed)">
                                    <span><i class="fa fa-comment"></i></span>
                                    <span>Comment</span>
                                </div>
                                <div class="mt-2">
                                    <a href="#" @click.prevent="showReportConfessionModal(feed.id)">Report</a>
                                </div>
                                <div class="mt-2" v-if="feed.user_id == $gate.userId()">
                                    <a href="#" @click.prevent="deleteConfession(feed.id)">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="trending">
                <div v-for="(feed, index) in trending_confessions">
                    <div class="d-flex bg-white py-2 mt-4 mb-4">
                        <div class="d-flex flex-column align-items-center justify-content-center mx-2">
                            <img :src="feed.category.image" width="40" class="my-2">
                            <small>{{ feed.category.name }}</small>
                            <button type="btn btn-primary">Follow</button>
                        </div>
                        <div class="d-flex flex-column justify-content-end my-1 ml-4">
                            <h4 class="mb-4">
                                {{ feed.text }}
                            </h4>
                            <div class="d-flex justify-content-between">
                                <div>
                                    By <a href="" class="">@{{ feed.username }}</a><br>
                                    <small class="text-muted">{{ feed.created_at }}</small>
                                </div>
                                <div class="text-muted mx-2">
                                    <span class="mr-2"><i class="fa fa-heart"></i> {{ feed.like_count }} feels</span>
                                    <span><i class="fa fa-comment"></i> 18 comments</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between border-top mt-2">
                                <div class="mt-2">
                                    <span @click.prevent="like(feed)"><i class="cursor-pointer fa fa-heart" :class="{ 'text-danger' : feed.is_liked}"></i></span>
                                    <span v-if="feed.is_liked">Unfeels</span>
                                    <span v-if="!feed.is_liked">Feels</span>
                                </div>
                                <div class="mt-2 mr-2">
                                    <span><i class="fa fa-comment"></i></span>
                                    <span>Comment</span>
                                </div>
                                <div class="mt-2">
                                    <a href="#" @click.prevent="showReportConfessionModal(feed.id)">Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="most-felt">
                <div class="d-flex bg-white py-2 mt-4 mb-4" v-for="feed in mostfelt_confessions">
                    <div class="d-flex flex-column align-items-center justify-content-center mx-2">
                        <img :src="feed.category.image" width="40" class="my-2">
                        <small>{{ feed.category.name }}</small>
                    </div>
                    <div class="d-flex flex-column justify-content-end my-1 ml-4">
                        <h4 class="mb-4">
                            {{ feed.text }}
                        </h4>
                        <div class="d-flex justify-content-between">
                            <div>
                                By <a href="" class="">{{ feed.username }}</a><br>
                                <small class="text-muted">{{ feed.created_at }}</small>
                            </div>
                            <div class="text-muted mx-2">
                                <span class="mr-2"><i class="fa fa-heart"></i> {{ feed.like_count }} feels</span>
                                <span><i class="fa fa-comment"></i> {{ feed.comment_count }} comments</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between border-top mt-2">
                            <div class="mt-2">
                                <span @click.prevent="like(feed)"><i class="cursor-pointer fa fa-heart" :class="{ 'text-danger' : feed.is_liked}"></i></span>
                                <span v-if="feed.is_liked">Unfeels</span>
                                <span v-if="!feed.is_liked">Feels</span>
                            </div>
                            <div class="mt-2 mr-2">
                                <span><i class="fa fa-comment"></i></span>
                                <span>Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="following">
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Show Feed Modal -->
        <modal name="feed-details" transition="pop-out" width="60%" height="auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 bg-secondary">
                        <div class="d-flex align-items-center py-2">
                            <img :src="feed.category.image" width="40">
                            <h6 class="pt-2 ml-2">{{ feed.category.name }}</h6>
                        </div>
                        <div id="div1" style="height: 500px;position:relative;">
                            <div id="div2" style="max-height:100%;overflow:auto; background-color: white;">
                                <div id="div3" style="height:600px;" class="p-4">
                                    {{ feed.text }}
                                </div>
                            </div>
                        </div>
                        <!-- <div style="background-color: white; max-height:100%;overflow:auto;border:1px solid red;">
            <div class="p-4 overflow-auto">
              hello
            </div>
          </div> -->
                        <div class="d-flex justify-content-between p-4">
                            <a href="#">Posted 2 days ago</a>
                            <a href="#">By Krishna Bhandari</a>
                        </div>
                    </div>
                    <!-- Right section -->
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <div>
                                <div class="pt-4">
                                    <i class="fa fa-heart"></i>
                                    <span>Feels</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>{{ feed.like_count }} feels</span>
                                    <span>{{ feed.comment_count }} comments</span>
                                </div>
                                <!-- <comment-list v-if="feed.comments" :collection="feed.comments" :comments="feed.comments.root"></comment-list> -->
                                <div v-for="comment in feed.comments">
                                    <div>
                                        <small class="font-bold">{{ comment.user.username }}</small>
                                        <div>{{ comment.content }}</div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                                        </div>
                                        <div v-if="comment == reply_comment && show_reply_form == true">
                                            <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                                            <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <recursive-comment :comment="comment"></recursive-comment>
                                    </div>
                                    <!-- <div v-if="comment.childrens">
                  <div v-for="comment in comment.childrens" class="ml-4">
                    <div>
                      <small class="font-bold">{{ comment.user.username }}</small>
                        <div>{{ comment.content }}</div>
                        <div class="d-flex justify-content-end mt-2">
                          <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                        </div>

                        <div v-if="comment == reply_comment">
                          <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                          <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                        </div>
                    </div>

                     <div v-if="comment.childrens">
                      <div v-for="comment in comment.childrens" class="ml-4">
                        <div>
                          <small class="font-bold">{{ comment.user.username }}</small>
                            <div>{{ comment.content }}</div>
                            <div class="d-flex justify-content-end mt-2">
                              <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                            </div>

                            <div v-if="comment == reply_comment">
                              <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                              <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                            </div>
                        </div>

                        <div v-if="comment.childrens">
                          <div v-for="comment in comment.childrens" class="ml-4">
                            <div>
                              <small class="font-bold">{{ comment.user.username }}</small>
                                <div>{{ comment.content }}</div>
                                <div class="d-flex justify-content-end mt-2">
                                  <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                                </div>

                                <div v-if="comment == reply_comment">
                                  <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                                  <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                                </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div> -->
                                </div>
                                <!-- <div  v-for="comment in feed.comments">
                <small class="font-bold">{{ comment.user.username }}</small>
                <div>{{ comment.content }}</div>
                <div class="d-flex justify-content-end mt-2">
                  <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                </div>

                <div v-if="comment == reply_comment">
                  <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                  <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                </div>
              </div> -->
                                <!-- <div>
                <small class="font-bold">Supernanny</small>
                <div>Haha super relate kami din ni wifey ganyan</div>
                <div class="d-flex justify-content-end mt-2">
                  <i class="fa fa-heart"></i>
                  <a href="#" class="ml-4">Reply</a>
                </div>
              </div> -->
                            </div>
                            <div class="mt-4">
                                <input type="text" class="form-control" v-model="feed.reply" placeholder="Add a comment..." v-on:keyup.enter="comment(feed)">
                                <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="comment(feed)">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <img src="/images/relationship.svg" width="20">
    <h4>Love & Relationship</h4> -->
        </modal>
        <report-confession-modal />
    </div>
</template>
<script>
import ReportConfessionModal from './ReportConfessionModal';
import Swal from 'sweetalert2';
export default {
    components: {
        ReportConfessionModal
    },
    data() {
        return {
            feeds: '',
            is_liked: '',
            // show_reply_form: false,
            reply_comment: {},
            reply_content: '',
            latest_confessions: '',
            trending_confessions: '',
            mostfelt_confessions: '',
            advertisements: '',
            ad_image: '',
            ad_url: '',
            feed: new Form({
                id: '',
                text: '',
                like_count: '',
                comment_count: '',
                reply: {},
                comments: {},
                category: {},
            })
        }
    },

    // computed: {
    //   feeds(){
    //     return this.$store.state.feeds;
    //   }
    // },

    // components: {
    //   'comment-list': CommentList
    // },

    methods: {
        getFeeds() {
            this.getLatestConfession();
        },

        deleteConfession(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete(`/confession/${id}/delete`)
                        .then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your confession has been deleted.',
                                'success'
                            )
                            Fire.$emit('ConfessionDeleted');
                        })
                }
            })
        },

        followUser(username) {
            axios.post('/follow/' + username)
                .then(() => {
                    Fire.$emit('FollowUpdated');
                })
                .catch((err) => {
                    //
                })
        },

        unfollowUser(username) {
            axios.post('/unfollow/' + username)
                .then(() => {
                    Fire.$emit('FollowUpdated');
                })
                .catch((err) => {
                    //
                })
        },

        showReportConfessionModal(feedId) {
            this.$modal.show('report-confession', { id: feedId });
        },

        like(feed) {
            if (feed.is_liked) {
                feed.like_count--;
                feed.is_liked = false;
            } else {
                feed.like_count++;
                feed.is_liked = true;
            }
            axios.post('/feeds/like', {
                    id: feed.id,
                })
                .then(({ data }) => {
                    if (data.success.attached != '') {
                        feed.is_liked = true;
                    } else {
                        feed.is_liked = false;
                        console.log('disliked');
                    }
                });
        },

        // getLatestConfession(){
        //   axios.get('/confessions/latest').then(response => {
        //     if(!response.data.error){
        //       response.data.data.forEach((feed) => {
        //         this.$store.commit('pushFeed',feed);
        //       });
        //     }
        //   });
        // },

        getLatestConfession() {
            axios.get('/confessions/latest')
                .then(({ data }) => {
                    this.latest_confessions = data;
                    // this.latest_confessions.splice(Math.floor(Math.random()*this.latest_confessions.length), 0, data);
                })
        },

        getTrendingConfession() {
            axios.get('/confessions/trending')
                .then(({ data }) => {
                    this.trending_confessions = data;
                })
        },

        getMostFeltConfession() {
            axios.get('/confessions/most-felt')
                .then(({ data }) => {
                    this.mostfelt_confessions = data;
                })
        },

        showFeed(feed) {
            this.feed.fill(feed);
            this.getComments(feed);
            this.$modal.show('feed-details');
        },



        getComments(feed) {
            axios.get('/confessions/' + feed.id + '/comments')
                .then(({ data }) => {
                    this.feed.comments = data;
                })
        },

        getCommentsBasedOnFeedId(feedId) {
            axios.get('/confessions/' + feedId + '/comments')
                .then(({ data }) => {
                    this.feed.comments = data;
                })
        },

        comment(feed) {
            axios.post('/feeds/comment', { content: feed.reply, feed_id: feed.id }).then(response => {
                feed.reply = '';
                feed.comment_count++;
                this.getComments(feed);
            });
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
                        this.show_reply_form = false;
                        this.getCommentsBasedOnFeedId(comment.feed_id);
                        // this.$store.commit('updateComments',payLoad);
                    }
                });
        },

        showReplyForm(comment) {
            this.reply_comment = comment;
            if (this.show_reply_form == true) {
                this.show_reply_form = false;
            } else {
                this.show_reply_form = true;
            }
            this.reply_content = '';
        },

        getAdvertisements() {
            axios.get('advertisements')
                .then(({ data }) => {
                    this.advertisements = data;
                })
        },

    },
    mounted() {
        Fire.$on('ConfessionCreated', () => {
            this.getFeeds();
        });
        this.getLatestConfession();
        this.getAdvertisements();
    },

    created() {
        Fire.$on('CommentUpdated', (feedId) => {
            this.getCommentsBasedOnFeedId(feedId);
        });
        Fire.$on('FollowUpdated', () => {
            this.getFeeds();
        });
        Fire.$on('ConfessionDeleted', () => {
            this.getFeeds();
        });
    }
}

</script>
<style>
.cursor-pointer {
    cursor: pointer;
}

.text-gray-dark {
    color: #343a40;
}

.bg-gray-200 {
    background-color: #edf2f7;
}

.h-full {
    height: 100%;
}

.w-7\/12 {
    width: 58.33%;
}

.w-7\/12 {
    width: 41.66%;
}

.-m-3 {
    margin: -0.75rem;
}

.pop-out-enter-active,
.pop-out-leave-active {
    transition: all 0.5s;
}

.pop-out-enter,
.pop-out-leave-active {
    opacity: 0;
    transform: translateY(24px);
}

</style>
