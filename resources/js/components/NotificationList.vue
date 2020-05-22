<template>
    <div>
        <div class="flex justify-between">
            <div class="text-gray-600">
                <h3 class="tracking-wide">NOTIFICATION</h3>
            </div>
            <div class="text-blue-500">
                <a href="/notifications/mark-all-as-read">Mark all as read</a>
            </div>
        </div>
        <div class="mt-4">
            <notification v-for="notification in notifications" :notification="notification" :key="notification.id"></notification>
        </div>
    </div>
</template>
<script>
import Notification from './Notification';
export default {
    components: {
        Notification
    },

    data() {
        return {
            notifications: ''
        }
    },

    methods: {
        getUserNotifications() {
            axios.get('/notifications')
                .then(({ data }) => {
                    this.notifications = data;
                })
        }
    },

    created() {
        this.getUserNotifications();
    }
}

</script>
