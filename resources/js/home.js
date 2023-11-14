import './bootstrap';
import { createApp } from 'vue';

import Home from './views/HomeView.vue';
import router from './router'

import { createPinia } from 'pinia';

import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import Card from 'primevue/card';
import 'primevue/resources/themes/mdc-light-deeppurple/theme.css'
import 'primeicons/primeicons.css';

const pinia = createPinia();
const home   = createApp(Home);

home.use(PrimeVue);
home.use(ToastService);
home.use(router)
home.use(pinia);

// PrimeVue Components
home.component('InputText', InputText)
home.component('Password', Password);
home.component('button', Button);
home.component('Card', Card);

home.mount('#app')

