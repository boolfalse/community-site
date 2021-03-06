/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

Vue.component('message', require('./components/message.vue'));

const app = new Vue({
    el: '#app',

    data: {
        message: '', // default message on init
        chat: {
            messages: []
        }
    },

    methods: {
        send(){
            if(this.message.length > 0){
                this.chat.messages.push(this.message);
                this.message = '';
            }
        }
    }
});
