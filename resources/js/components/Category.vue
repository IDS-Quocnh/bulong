<template>
    <a :href="'/category/' + category.slug" class="px-6 mb-3 flex">
        <img :src="category.image" class="mr-3 w-8 h-8" />
        <h2>{{ category.name }}</h2>
    </a>
</template>
<script>
export default {
    props: ['category'],
}

</script>
