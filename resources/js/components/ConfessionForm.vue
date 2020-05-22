<template>
    <div>
        <div class="bg-gray-400">
            <div class="px-3 pt-3 pb-1">
                <!-- <textarea v-model="text" class="px-2 pt-2 w-full text-xl focus:outline-none" placeholder="I have something to confess..." rows="5">
                </textarea> -->
                <div class="home-page">
                    <textarea-emoji-picker v-model="text" :backgroundImage="this.backgroundImage" />
                </div>
            </div>
            <div class="flex justify-between items-center pb-1">
                <div class="ml-4 cursor-pointer">
                    <!-- <i class="fa fa-smile-o mr-2"></i> -->
                    <i class="ml-6 fa fa-image text-gray-600 hover:text-black" @click.prevent="showBackgroundImagesModal()"></i>
                </div>
                <div class="mr-3">
                    <button @click.prevent="showCategoryModal()" class="px-8 bg-blue-500 rounded text-white">
                        <span v-if="!editMode">Post</span>
                        <span v-if="editMode">Update</span>
                    </button>
                </div>
            </div>
        </div>
        <modal name="categoryModal" height="auto" transition="pop-out">
            <div>
                <div class="bg-gray-400">
                    <h4 class="p-4 text-xl">Select a category for your confession</h4>
                </div>
                <div class="bg-gray-300 p-2 flex flex-wrap">
                    <div @click.prevent="markAsSelected(category)" class="mb-2 w-6/12 p-2 bg-white border flex items-center" v-for="category in categories" :key="category.id">
                        <img :src="category.image" width="40">
                        <h1 class="ml-2">{{ category.name }}</h1>
                        <span class="ml-2 text-green-600 text-2xl">
                            <i class="fa fa-check-circle-o" v-if="category.id === selectedCategory.id"></i>
                        </span>
                    </div>
                </div>
                <div class="p-2 flex justify-between items-center">
                    <a href="#" @click.prevent="hideCategoryModal()" class="hover:text-blue-600">Back</a>
                    <button v-if="!editMode" :disabled="loading" @click.prevent="publishConfession()" class="bg-blue-600 p-2 px-6 text-white rounded">
                        <i v-if="loading" class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                        Publish
                    </button>
                    <button v-if="editMode" :disabled="loading" @click.prevent="updateConfession()" class="bg-blue-600 p-2 px-6 text-white rounded">
                        <i v-if="loading" class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                        Update
                    </button>
                </div>
            </div>
        </modal>
        <modal name="backgroundImagesModal" height="auto" transition="pop-out">
            <div>
                <div class="bg-gray-400">
                    <h4 class="p-4 text-xl">Select background for your confession</h4>
                </div>
                <div class="bg-gray-300 p-2 flex flex-wrap">
                    <div @click.prevent="markAsSelectedBackground(background)" class="mb-2 w-3/12 p-2 bg-white border flex items-center" v-for="background in backgrounds" :key="background.id">
                        <div class="relative">
                            <img :src="background.image" class="w-full">
                            <span class="mr-2 text-green-600  absolute top-0 right-0">
                                <i class="fa fa-check-circle-o" v-if="background === selectedBackground"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-2 flex justify-between items-center">
                    <a href="#" @click.prevent="hideBackgroundImageModal()" class="hover:text-blue-600">Back</a>
                    <button @click.prevent="hideBackgroundImageModal()" class="bg-blue-600 p-2 px-6 text-white rounded">
                        <i v-if="loading" class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                        Continue
                    </button>
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import TextareaEmojiPicker from './TextareaEmojiPicker'
export default {
    components: { TextareaEmojiPicker },
    data() {
        return {
            id: '',
            selectedCategory: '',
            text: '',
            loading: false,
            backgrounds: [],
            selectedBackground: '',
            backgroundImage: 'public/images/backgrounds/Default_Background.png',
            editMode: false
        }
    },

    methods: {
        showCategoryModal() {
            if (this.isNullOrWhiteSpace(this.text)) {
                Vue.$toast.error('Your post is empty')
            } else {
                this.$modal.show('categoryModal')
            }
        },

        hideCategoryModal() {
            this.$modal.hide('categoryModal');
        },

        markAsSelected(category) {
            this.selectedCategory = category;
        },

        publishConfession() {
            this.loading = true;
            axios.post('/confession/create', {
                    text: this.text,
                    categoryId: this.selectedCategory.id,
                    backgroundId: this.selectedBackground.id
                })
                .then(({ data }) => {
                    console.log(data)
                    Vue.$toast.open({
                        message: 'Your confession has been posted. Click here to view it now.',
                        type: 'success',
                        onClick: () => {
                            window.location.href = '/confessions/' + data.id
                        }
                    });
                    this.$modal.hide('categoryModal');
                    this.text = '';
                    this.loading = false;
                    this.$emit('confessionPublished');
                })
                .catch(() => {
                    this.loading = false;
                })
        },

        updateConfession() {
            this.loading = true;
            axios.patch(`/confession/${this.id}/update`, {
                    text: this.text,
                    categoryId: this.selectedCategory.id,
                    backgroundId: this.selectedBackground.id
                })
                .then(() => {
                    Vue.$toast.open('Your confession has been updated. Click here to view it now.');
                    this.$modal.hide('categoryModal');
                    this.text = '';
                    this.loading = false;
                    this.$emit('confessionPublished');
                    this.editMode = false;
                    this.selectedCategory = ''
                    this.selectedBackground = ''
                })
                .catch(() => {
                    this.loading = false;
                })
        },

        getBackgroundImages() {
            axios.get('/background-images')
                .then(({ data }) => {
                    this.backgrounds = data;
                })
        },

        showBackgroundImagesModal() {
            this.$modal.show('backgroundImagesModal')
        },

        markAsSelectedBackground(background) {
            this.selectedBackground = background;
            this.backgroundImage = background.image;
        },

        hideBackgroundImageModal() {
            this.$modal.hide('backgroundImagesModal');
        },

        isNullOrWhiteSpace(str) {
            return (!str || str.length === 0 || /^\s*$/.test(str))
        }
    },

    computed: {
        categories() {
            return this.$store.state.categories;
        },

        backgrounds() {
            return this.$store.state.backgrounds;
        }
    },

    created() {
        this.getBackgroundImages()

        Fire.$on('EditConfession', (id) => {
            this.editMode = true
            axios.get(`/confession/${id}/edit`)
                .then(({ data }) => {
                    this.id = data.id
                    this.text = data.text
                    this.backgroundImage = data.background.image
                    this.selectedCategory = data.category
                })
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

</style>
