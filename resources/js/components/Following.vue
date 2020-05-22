<template>
    <div class="mr-4 mt-5 p-4 bg-white w-32 border flex flex-col justify-center items-center">
        <div>
            <a :href="'/user/' + person.username">
                <img src="public/images/profile.jpg" class="h-20 w-20 rounded-full">
            </a>
            <a :href="'/user/' + person.username" class="text-teal-600 font-bold">{{ person.username }}</a>
        </div>
    </div>
</template>
<script>
export default {
    props: ['person'],
}

</script>
