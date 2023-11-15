import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import PokemonView from '../views/PokemonView.vue';
import TrainerView from '../views/TrainerView.vue';
import ProfileView from '../views/ProfileView.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes : [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/pokemon',
            name: 'pokemon',
            component: PokemonView
        },
        {
            path: '/trainer',
            name: 'trainer',
            component: TrainerView
        },
        {
            path: '/profile',
            name: 'profile',
            component: ProfileView,

        }
    ]
});

export default router
