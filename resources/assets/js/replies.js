
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

import store from './store'
import {Message, MessageBox, Notification, Tag} from 'element-ui'
import Replies from './components/Replies'
import ReplyBox from './components/ReplyBox'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('replies', require('./components/Replies.vue'));
Vue.component(Tag.name, Tag);
Vue.prototype.$message = Message;
Vue.prototype.$msgbox = MessageBox;
Vue.prototype.$alert = MessageBox.alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$notify = Notification;

// Vue.use(Tag);

const app = new Vue({
    el: '#replies',
    store,
    components: {
        Replies,
        ReplyBox
    }
});
