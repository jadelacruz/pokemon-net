import { ref } from 'vue';
import { defineStore } from 'pinia';
import * as yup from 'yup';

export const useRegisterStore = defineStore('registerStore', () => {
    const firstName  = ref('');
    const lastName   = ref('');
    const email      = ref('');
    const password   = ref('');
    const rePassword = ref('');

    const schema = yup.object({
        firstName: yup.string()
            .required()
            .min(2)
            .max(30)
            .label('First Name'),
        lastName: yup.string()
            .required()
            .min(2)
            .max(30)
            .label('Last name'),
        email: yup.string()
            .required()
            .email()
            .min(8)
            .max(100)
            .label('Email Address'),
        password: yup.string()
            .required()
            .min(8)
            .max(16)
            .label('Password'),
        rePassword: yup.string()
            .required()
            .oneOf([yup.ref('password')], 'Password do not match')
            .label('Retyped Password')
    });

    const errors = {};

    return { firstName, lastName, email, password, rePassword, schema, errors };
});
