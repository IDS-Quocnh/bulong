<template>
    <div class="flex flex-col text-gray-600">
        <h3 class="text-gray-700 mb-4 px-6 mt-3 ">Categories</h3>
        <category v-for="category in categories" :category="category" :key="category.id"></category>
    </div>
</template>
<script>
import Category from './Category';
export default {
    components: {
        Category
    },

    data() {
        return {
            //
        }
    },

    computed: {
        categories() {
            return this.$store.state.categories;
        }
    },

    methods: {
        //
    },

    created() {
        this.$store.dispatch('getCategories');
    }
}

</script>
