import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        feeds: [],
    },

    mutations: {
        pushFeed(state, payLoad) {
            state.feeds.unshift(payLoad);
        },
        updateComments(state, payLoad) {
            let feed = state.feeds.find((feed) => {
                return payLoad.feed_id === feed.id;
            });
            feed.comments = payLoad['comments'];
        }
    }
});
