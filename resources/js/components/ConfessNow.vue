<template>
    <div v-cloak>
        <div class="bg-secondary mt-4 rounded">
            <div class="d-flex flex-column p-2">
                <!-- <textarea class="form-control id-dimmer" rows="5" placeholder="Confess Now.." v-model="text"></textarea> -->
                <VueEmoji ref="emoji" @input="onInput" height="100" width="100%" :value="myText" class="form-control" />
                <div class="bg-gray-700 p-2">
                    <button class="btn btn-outline-success btn-rounded pull-right" @click.prevent="post">Post</button>
                </div>
            </div>
        </div>
        <modal name="hello-world" height="auto" :scrollable="true" transition="pop-out">
            <div class="container">
                <div class="row bg-secondary ">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="p-2">
                            <strong>Select a category for your confession</strong>
                        </h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <!-- <div class="col-md-6 flex-column">
                <div class="bg-secondary d-flex align-items-center mb-2 category" @click="selectCategory()">
                  <img src="/images/relationship.svg" width="40" class="my-2 mr-2">
                  <h5 class="my-2">Love and Relationship <i class="fa fa-check-circle-o" v-if="this.selected_category == true"></i></h5>
              </div>
            </div> -->
                    <div class="col-md-6" v-for="category in categories">
                        <div class="bg-secondary d-flex align-items-center mb-2 category" @click="selectCategory(category)">
                            <img :src="category.image" width="40" class="my-2 mr-2">
                            <h5 class="my-2">{{ category.name }} <i class="fa fa-check-circle-o" v-if="category == selected_category"></i></h5>
                        </div>
                    </div>
                    <div class="col-md-12 py-2">
                        <a href="#" @click.prevent="back()">
                            < Back</a> <button class="btn btn-outline-success btn-rounded pull-right" @click.prevent="publish">Publish</button>
                    </div>
                    <!-- <div class="col-md-6">
                <div class="bg-secondary d-flex align-items-center">
                  <img src="/images/relationship.svg" width="40" class="my-2 mr-2">
                  <h5 class="my-2">Love and Relationship</h5>
              </div>
            </div> -->
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import VueEmoji from 'emoji-vue'
export default {
    components: {
        VueEmoji,
    },
    data() {
        return {
            text: '',
            selected_category: '',
            categories: '',
        }
    },
    methods: {
        onInput(event) {
            //event.data contains the value of the textarea
            this.text = event.data;
        },
        clearTextarea() {
            this.$refs.emoji.clear()
        },

        post() {
            this.$modal.show('hello-world');
        },

        publish() {
            axios.post('/feeds/store', {
                    text: this.text,
                    category_id: this.selected_category.id,
                })
                .then(() => {
                    Fire.$emit('ConfessionCreated');
                    this.$modal.hide('hello-world');
                    this.text = '',
                        this.$toasted.success('Your confession is posted successfully!', {
                            icon: {
                                name: 'fa-check-circle-o'
                            }
                        })
                })
                .catch(() => {
                    this.$toasted.error('Please fill out the fill.')
                })
        },

        back() {
            this.$modal.hide('hello-world');
        },

        selectCategory(category) {
            this.selected_category = category;
            console.log(this.selected_category);
        }
    },
    mounted() {
        axios.get('categories')
            .then(({ data }) => {
                this.categories = data;
            })
    }
}

</script>
<style>
.category {
    cursor: pointer;
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

.emoji-wysiwyg-editor {
    border: none;
}

</style>
