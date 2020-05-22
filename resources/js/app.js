/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal'
Vue.use(VModal, { dynamic: true, injectModalsContainer: true, dialog: true })

window.Fire = new Vue();

import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

// import Toasted from 'vue-toasted';
// Vue.use(Toasted, {
//     theme: 'outline',
//     duration: 5000,
// })

import VueToasted from 'vue-toasted';
Vue.use(VueToasted, {
    iconPack: 'fontawesome',
    theme: 'outline',
    duration: 5000,
});

import infiniteScroll from 'vue-infinite-scroll'
Vue.use(infiniteScroll)

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueToast from 'vue-toast-notification';
// Import any of available themes
import 'vue-toast-notification/dist/theme-default.css';
//import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast, {
    position: 'top-right'
});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import App from './components/App';
import Index from './components/Index';
import Notification from './components/Notification';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('confess-now', require('./components/ConfessNow.vue').default);
Vue.component('feed', require('./components/Feed.vue').default);
Vue.component('category-based-feed', require('./components/CategoryBasedFeed.vue').default);
Vue.component('tag-based-feed', require('./components/TagBasedFeed.vue').default);
Vue.component('search-results', require('./components/SearchResults.vue').default);
Vue.component('recursive-comment', require('./components/RecursiveComment.vue').default);
Vue.component('account-deletion-alert', require('./components/AccountDeletionAlert.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));
Vue.component('confession-menu', require('./components/ConfessionMenu.vue').default);
Vue.component('following-list', require('./components/FollowingList.vue').default);
Vue.component('personal-menu', require('./components/PersonalMenu.vue').default);
Vue.component('notification-list', require('./components/NotificationList.vue').default);
Vue.component('confession', require('./components/Confession.vue').default);
Vue.component('register-form', require('./components/RegisterForm.vue').default);
Vue.component('following', require('./components/Following.vue').default);
Vue.component('comment-section', require('./components/CommentSection.vue').default);
Vue.component('category-based-confession', require('./components/CategoryBasedConfession.vue').default);
Vue.component('user-based-confessions', require('./components/UserBasedConfessions.vue').default);
Vue.component('user-info', require('./components/UserInfo.vue').default);
Vue.component('confession-detail', require('./components/ConfessionDetail.vue').default);

/** Login form component */
Vue.component('login-form', require('./components/LoginForm.vue').default);
/** Login form component */

/** Category List Component */
Vue.component('category-list', require('./components/CategoryList.vue').default);
/** Category List Component */

/** Confession Form Component */
Vue.component('confession-form', require('./components/ConfessionForm').default);
/** Confession Form Component */

/** Confession List Component */
Vue.component('confession-list', require('./components/ConfessionList.vue').default);
/** Confession List Component */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import { store } from './store';
import store from './store/index.js';

const app = new Vue({
    el: '#app',
    store: store,
    components: { App },
});
