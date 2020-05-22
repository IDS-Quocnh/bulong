<template>
    <div class="">
        <confession v-if="activeMenu == 'trending'" v-for="confession in trendingConfessions" :confession="confession" :key="confession.id"></confession>
        <confession v-if="activeMenu == 'latest'" v-for="confession in latestConfessions" :confession="confession" :key="confession.id"></confession>
        <confession v-if="activeMenu == 'following'" v-for="confession in followingPeopleConfessions" :confession="confession" :key="confession.id"></confession>
        <modals-container />
    </div>
</template>
<script>
import FollowingList from './FollowingList';
import Confession from './Confession';

export default {
    components: {
        FollowingList
    },

    data() {
        return {
            //
        }
    },

    components: {
        Confession
    },

    methods: {
        getConfessions() {
            axios.get('/confessions')
                .then(({ data }) => {
                    this.confessions = data.data;
                })

        },

        showReportConfessionModal(id) {
            this.$modal.show({
                template: `
                <div class="p-4 flex justify-center">
                    <h1>djlaj</h1>
                </div>
              `,
                props: ['text']
            }, {
                text: 'This text is passed as a property'
            }, {
                height: 'auto',
                width: 250
            }, {
                'before-close': (event) => { console.log('this will be called before the modal closes'); }
            })
        },
    },

    computed: {
        trendingConfessions() {
            return this.$store.state.trendingConfessions;
        },
        latestConfessions() {
            return this.$store.state.latestConfessions;
        },
        followingPeopleConfessions() {
            return this.$store.state.followingPeopleConfessions;
        },
        activeMenu() {
            return this.$store.state.activeMenu;
        }
    },

    created() {
        this.$on('confessionPublished', () => {
            this.confessions = '';
            axios.get('/confessions')
                .then(({ data }) => {
                    this.confessions = data.data;
                })
        });

        this.$store.dispatch('getTrendingConfessions');
    }
}

</script>
