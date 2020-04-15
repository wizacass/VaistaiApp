require('./bootstrap');

window.Vue = require('vue');

Vue.component('mainmenu', require('./components/Menu.vue').default);

const menuApp = new Vue({
    el: '#vueMenu',
});
