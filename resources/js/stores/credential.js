import { ref } from 'vue';
import { defineStore } from 'pinia';
import * as yup from 'yup';

export const useCredentialStore = defineStore('user', () => {
    const email    = ref('');
    const password = ref('');

    const schema = yup.object({
        email: yup.string()
            .required()
            .email()
            .label('Email Address'),
        password: yup.string()
            .required()
            .label('Password')
    });

    return { email, password, schema };
});
