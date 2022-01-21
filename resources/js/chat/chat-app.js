/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex'
import App from './components/App.vue'

import store from './store'
import { getChatData } from './store/actions'
import mixins from './mixins'

// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import VueI18n from 'vue-i18n'

import VueSocketIO from 'vue-socket.io'
import SocketIO from 'socket.io-client'

// import 'es6-promise/auto'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/App.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./components/App.vue').default);

Vue.config.debug = true

Vue.filter('time', timestamp => {
    return new Date(timestamp).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
})

Vue.filter('size', bytes => {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    if (bytes == 0) return '0 Byte'
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)))
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i]
})

// Import Bootstrap an BootstrapVue CSS files (order is important)

// import 'bootstrap-vue/dist/bootstrap-vue.css';

// Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin);
// Vue.use(VueI18n)
Vue.use(Vuex)

const options = { transports: ['websocket', 'polling', 'flashsocket'] }

Vue.use(new VueSocketIO({
        debug: true,
        connection: SocketIO('http://localhost:3000', options), //options object is Optional
        vuex: {
            store,
            actionPrefix: "SOCKET_",
            mutationPrefix: "SOCKET_"
        }
    })
);

Vue.mixin(mixins)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

getChatData(store)

const app = new Vue({
    el: '#app',
    store,
    render: h => h(App)
});
