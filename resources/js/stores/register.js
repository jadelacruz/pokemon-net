import { ref } from 'vue';
import { defineStore } from 'pinia';

export const useRegisterStore = defineStore('registerStore', () => {
    const name       = ref('');
    const username   = ref('');
    const password   = ref('');
    const rePassword = ref('');

    return { name, username, password, rePassword };
});
