/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createStore } from 'vuex'

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const store = createStore({
  state: {
    onGame: false,
  },
})

const app = createApp({});
app.use(store)

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import LoginComponent from './components/LoginComponent.vue';
app.component('login-component', LoginComponent);

import RegisterComponent from './components/RegisterComponent.vue';
app.component('register-component', RegisterComponent);

import HomeGameComponent from './components/HomeGameComponent.vue';
app.component('home-game-component', HomeGameComponent);

import EndGameModalComponent from './components/EndGameModalComponent.vue';
app.component('end-modal-component', EndGameModalComponent);

import StartGameModalComponent from './components/StartGameModalComponent.vue';
app.component('start-modal-component', StartGameModalComponent);

import HomePageComponent from './components/HomePageComponent.vue';
app.component('home-page-component', HomePageComponent);

import ButtonLinkComponent from './components/ButtonLinkComponent.vue';
app.component('button-link-component', ButtonLinkComponent);

import RankComponent from './components/RankComponent.vue';
app.component('rank-component', RankComponent);

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
