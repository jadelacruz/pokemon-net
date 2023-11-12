import './bootstrap';
import { createApp } from 'vue';

import Dashboard from './views/DashboardView.vue';
import router from './router'

import { createPinia } from 'pinia';

import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import MenuBar from 'primevue/menubar';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import Card from 'primevue/card';
import 'primevue/resources/themes/mdc-light-deeppurple/theme.css'

const pinia = createPinia();
const app   = createApp(Dashboard);

app.use(PrimeVue);
app.use(ToastService);
app.use(router)
app.use(pinia);

// PrimeVue Components
app.component('MenuBar', MenuBar);
app.component('InputText', InputText)
app.component('Password', Password);
app.component('button', Button);
app.component('Card', Card);

app.mount('#app')

