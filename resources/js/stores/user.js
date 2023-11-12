import { ref } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', () => {
    const name     = ref('');
    const username = ref('');
    const password = ref('');

    return { name, username, password };
});
