require('./bootstrap');

console.log("Running JS...");

window.Vue = require('vue');

Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('mainmenu', require('./components/Menu.vue').default);

const menuApp = new Vue({
    el: '#vueMenu',
});
