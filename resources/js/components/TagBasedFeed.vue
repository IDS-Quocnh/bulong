  <template>
<div>

  <div class="row">
    <div class="col-md-12">
      <div class="d-flex flex-column align-items-center mt-4">
        <img :src="category_image" width="80">
        <h5 class="mt-2">{{ category_name }}</h5>
        <h3>#{{ this.slug }}</h3>
      </div>
    </div>
  </div>

  <div class="d-flex bg-white py-2 mt-4 mb-4" v-for="feed in latest_confessions">
    <div class="d-flex flex-column align-items-center justify-content-center mx-2">
        <img :src="feed.category.image" width="40" class="my-2">
        <small>{{ feed.category.name }}</small>
    </div>

    <div class="d-flex flex-column justify-content-end my-1 ml-4">
        <h4 class="mb-4">
            <a href="#" @click.prevent="showFeed(feed)" class="text-gray-dark">{{ feed.text }}</a>
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
            <div class="mt-2 cursor-pointer " @click.prevent="like(feed)">
                <span><i class="fa fa-heart" :class="{ 'text-danger' : feed.is_liked}"></i></span>
                <span v-if="feed.is_liked">Unfeels</span>
                <span v-if="!feed.is_liked">Feels</span>
            </div>

            <div class="mt-2 mr-2 cursor-pointer" @click.prevent="showFeed(feed)">
              <span><i class="fa fa-comment"></i></span>
              <span>Comment</span>
            </div>
        </div>
    </div>
</div>

<div v-if="latest_confessions == ''" class="d-flex bg-white py-2 mt-4 mb-4 justify-content-center">No confessions found on this category...</div>

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

              <div  v-for="comment in feed.comments">
                <small class="font-bold">{{ comment.user.username }}</small>
                <div>{{ comment.content }}</div>
                <!-- <div class="d-flex justify-content-end mt-2">
                  <i class="fa fa-heart block"></i><br>
                  <a href="#" @click.prevent="showReplyForm(comment)" class="ml-4">Reply</a>
                </div> -->
                <!-- <div v-if="show_reply_form">
                  <input type="text" v-model="reply_content" class="form-control" v-on:keyup.enter="replyTo(comment)">
                  <button class="flex pull-right btn btn-sm btn-primary mt-2 rounded" @click.prevent="replyTo(comment)">Post</button>
                </div> -->
              </div>

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

</div>
</template>

<script>
  // import CommentList from './CommentList.vue';
  export default {
  props: ['slug'],
  data() {
    return {
      feeds: '',
      is_liked: '',
      show_reply_form: false,
      reply_content: '',
      latest_confessions: '',
      trending_confessions: '',
      mostfelt_confessions: '',
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

  methods: {
    getFeeds() {
      this.getCategoryConfession();
    },

    like(feed) {
      if(feed.is_liked) {
        feed.like_count -- ;
        feed.is_liked = false;
      } else {
        feed.like_count ++;
        feed.is_liked = true;
      }
      axios.post('/feeds/like', {
        id: feed.id,
      })
      .then(({data}) => {
        if(data.success.attached != '') {
          feed.is_liked  = true;
        } else {
          feed.is_liked = false;
          console.log('disliked');
        }
      });
    },

    getCategoryConfession() {
      axios.get('/tag/' + this.slug)
      .then(({data}) => {
        this.latest_confessions = data;
      })
    },

    getTrendingConfession() {
      axios.get('/confessions/trending')
      .then(({data}) => {
        this.trending_confessions = data;
      })
    },

    getMostFeltConfession() {
      axios.get('/confessions/most-felt')
      .then(({data}) => {
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
      .then(({data}) => {
        this.feed.comments = data;
      })
    },

    comment(feed) {
      axios.post('/feeds/comment', {content: feed.reply, feed_id: feed.id}).then(response => {
        feed.reply = '';
        feed.comment_count ++;
        this.getComments(feed);
      });
    },

    replyTo(comment){
      axios.post('/feeds/comment', {content: this.reply_content, feed_id: comment.feed_id, parent_id: comment.id}).then(response => {
         this.content = '';
         if (!response.data.error) {
          this.content = '';
          let payLoad = {
              post_id: comment.post_id,
              comments: response.data.data
          };
          this.$store.commit('updateComments',payLoad);
      }
  });
  },

    showReplyForm() {
      this.show_reply_form = true;
    },

  },
   mounted() {
      Fire.$on('ConfessionCreated', () => {
        this.getFeeds();
      });
      this.getCategoryConfession();
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
