/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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

// Vue.component('map-component', require('./components/MapComponent.vue').default);

Vue.component('uploader-component', require('./components/UploaderComponent.vue').default);

Vue.component('uploaderx-component', require('./components/UploaderxComponent.vue').default);

Vue.component('products-component', require('./components/ProductsComponent.vue').default);

Vue.component('project-reports', require('./components/ProjectReports.vue').default);

Vue.component('admin-products-component', require('./components/admin/AdminProductsComponent.vue').default);

Vue.component('product-categories-component', require('./components/admin/ProductCategoriesComponent.vue').default);

Vue.component('file-manager-component', require('./components/admin/FileManagerComponent.vue').default);

Vue.component('transactions-component', require('./components/admin/TransactionsComponent.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
