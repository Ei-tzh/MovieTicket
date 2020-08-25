/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte/dist/js/adminlte.min.js');
require('bootstrap-duration-picker/dist/bootstrap-duration-picker.js');
require('bootstrap-duration-picker/dist/bootstrap-duration-picker-debug.js');

//require('');
//require('bootstrap-switch-button/dist/js/bootstrap-switch-button.min.js');
window.Vue = require('vue');


import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery-ui/ui/widgets/datepicker.js';
import 'jquery-ui/ui/widgets/spinner.js';
import 'jquery-ui/ui/widgets/button.js';
import  'select2/dist/js/select2.min.js';
import  'bootstrap-switch/dist/js/bootstrap-switch.min.js';//bootstrap-switch
window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
