/** setup vued rouuter */
import * as VueRouter from 'vue-router'; // alternative ways of importing
import Dashboar from './components/Dashboar.vue';
import Category from './components/Category.vue';
import Product from './components/Product.vue';
import Member from './components/Member.vue';
import purchasing from './components/Purchasing.vue';
import supplier from './components/Supplier.vue';
import purchasingDetail from './components/Purchasing_detail.vue';

let routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboar,
    },
    {
        path: '/member',
        name: 'member',
        component: Member,
    },
    {
        path: '/category',
        name: 'category',
        component: Category,
    },
    {
        path: '/product',
        name: 'product',
        component: Product,
    },
    {
        path: '/supplier',
        name: 'supplier',
        component: supplier,
    },
    {
        path: '/purchasing',
        name: 'purchasing',
        component: purchasing,
    },
    {
        path: '/purchasingDetail',
        name: 'purchasingDetail',
        component: purchasingDetail,
    }
];

const router = VueRouter.createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    // history: VueRouter.createWebHashHistory(),
    history: VueRouter.createWebHistory(),
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

// font awsome
// import { library } from '@fortawesome/fontawesome-svg-core';
// import { fas } from '@fortawesome/free-solid-svg-icons';
// library.add(fas);
// app.component('fa', FontAwesomeIcon);


app.mount('#app');
