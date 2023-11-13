<script setup>
    import { defineEmits, ref } from 'vue';
    import { useCredentialStore } from '../stores/credential';

    import { handleValidationError } from '../common/utility';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import AuthRest from '../rest/rest.auth';

    const emit         = defineEmits([ 'show-toast','show-register' ]);
    const credential   = { ...useCredentialStore() };
    const errors       = ref({});
    const loginLoading = ref(false);

    const csrfToken = () => document.querySelector('meta[name="csrf-token"]').content;
    const login     = async () => {
        try {
            errors.value       = {};
            loginLoading.value = true;
            console.log(credential);
            const validForm = await credential.schema.validate(credential, { abortEarly: false });
            const response  = await AuthRest.attempt(validForm);

            if (response && response.status === 200) {
                emit('show-toast', {
                    severity: 'success',
                    info: 'Login',
                    detail: response.data?.message,
                    life: 4000
                });

                setTimeout(() => {
                    document.getElementById('login-form').submit();
                }, 2000);
            }
        } catch (e) {
            handleValidationError(errors, e);

            if (e.name === 'AxiosError') {
                const { response } = e;
                if (response.status === 401) {
                    emit('show-toast', {
                        severity: 'error',
                        info: 'Login',
                        detail: response.data?.message,
                        life: 4000
                    });
                } else {
                    errors.value = e.response.data?.errors;
                }
            }

            loginLoading.value = false;
        }
    }
</script>

<template>
        <form id="login-form"
              action="/authenticate"
              method="POST">
            <InputText type="hidden"
                       name="_token"
                       :value="csrfToken()" />
            <div class="mb-1">
                <InputText
                    :class="{ 'input-fluid': true, 'p-invalid': errors.email?.length }"
                    type="text"
                    name="email"
                    placeholder="Email"
                    v-model="credential.email">
                </InputText>
                <small v-if="errors.email?.length"
                       class="p-error">{{ errors.email[errors.email.length - 1] }}</small>
            </div>

            <div class="mb-1">
                <InputText
                    :class="{ 'input-fluid': true, 'p-invalid': errors.password?.length }"
                    type="password"
                    name="password"
                    placeholder="Password"
                    v-model="credential.password">
                </InputText>
                <small v-if="errors.password?.length"
                       class="p-error">{{ errors.password[errors.password.length - 1] }}</small>
            </div>

            <div class="control-area">
                <Button
                    label="Register"
                    severity="info"
                    @click.prevent="emit('show-register')">
                </Button>

                <Button
                    class="control"
                    label="Login"
                    severity="secondary"
                    :loading="loginLoading"
                    @click.prevent="login">
                </Button>
            </div>
        </form>
</template>
