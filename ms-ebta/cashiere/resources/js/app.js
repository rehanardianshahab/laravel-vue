/** setup vued rouuter */
import * as VueRouter from 'vue-router'; // alternative ways of importing
import Dashboar from './components/Dashboar.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Category from './components/Category.vue';
import ApaIni from './components/ApaIni.vue';

let routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboar,
    },
    {
        path: '/sample',
        name: 'sample',
        component: ExampleComponent,
    },
    {
        path: '/category',
        name: 'category',
        component: Category,
    },
    {
        path: '/apaini',
        name: 'apaini',
        component: ApaIni,
    }
];

const router = VueRouter.createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: VueRouter.createWebHashHistory(),
    routes, // short for `routes: routes`
});
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(router);

// import Dashboar from './components/Dashboar.vue';
// app.component('example-component', ExampleComponent);
// app.component('apa-ini', ApaIni);
// app.component('laman-dashboard', Dashboar);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
