
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

Vue.component('attachments', require('./components/AttachmentsComponent.vue'));
Vue.component('editor', require('./components/EditorComponent.vue'));
Vue.component('upload-input', require('./components/UploadInputComponent.vue'));
Vue.component('admin-fields', require('./components/AdminFieldsComponent.vue'));



const app = new Vue({
    el: '#app'
});
