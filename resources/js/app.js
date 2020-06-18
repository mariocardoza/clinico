/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

import router from './router'
window.Vue = require('vue');

import Permissions from './mixins/Permissions';
Vue.mixin(Permissions);

//window.$ = window.jQuery = require('jquery');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('App', require('./components/App.vue').default);

Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('inicio-component', require('./components/InicioComponent.vue').default);
//users
Vue.component('user-component', require('./components/UsersComponent.vue').default);
<<<<<<< HEAD
Vue.component('user-create-component', require('./components/UserCreateComponent.vue').default);
=======
Vue.component('unidades-component', require('./components/UnidadesComponent.vue').default);
>>>>>>> d1943de6ce78004daeb6843111620bbe7d8f0c44

//error 404
Vue.component('error-component', require('./components/ErrorComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
}).$mount("#app");
