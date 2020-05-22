<template>
    <div class="flex bg-white p-2 mt-4 shadow hover:shadow-lg">
        <div>
            <img src="/images/profile.png" class="mr-4 h-10 w-10">
        </div>
        <div class="ml-2">
            <p class="text-blue-600">@{{ notification.data.username }} <span class="text-gray-600 text-sm">
                    <span v-if="notification.type == 'App\\Notifications\\FeltConfession'">liked your</span>
                    <span v-if="notification.type == 'App\\Notifications\\CommentedConfession'">commented on</span>
                    confession </span>
                <a href="" class="hover:underline">"{{ notification.data.confession }}"</a>
            </p>
            <div class="text-sm text-gray-500 mt-1">1 day ago</div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['notification'],
}

</script>
