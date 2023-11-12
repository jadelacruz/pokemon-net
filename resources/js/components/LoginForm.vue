<script setup>
    import { defineEmits, ref, computed } from 'vue';
    import { useUserStore } from '../stores/user';

    import Card from 'primevue/card';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import RegisterForm from './RegisterForm.vue';
    import AuthRest from '../rest/rest.auth';

    const emit = defineEmits(['show-toast']);
    const { name, username, password } = useUserStore();
    const user    = { name, username, password };
    const mode    = ref('login');
    const errors  = ref({});
    const loginLoading = ref(false);
    const isLogin = computed(() => mode.value === 'login');

    const onRegisterClicked = () => {
        mode.value = (mode.value === 'login') ? 'register' : 'login';
    }

    const onShowLogin = () => {
        mode.value = 'login';
    }

    const csrfToken = () => document.querySelector('meta[name="csrf-token"]').content;

    const login = async () => {
        try {
            loginLoading.value = true;
            errors.value       = {};
            const { username, password } = user;
            const response = await AuthRest.attempt({ username, password });

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
            if (e.name === 'AxiosError') {
                const { response } = e;

                if (response.status === 401) {
                    emit('show-toast', {
                        severity: 'error',
                        info: 'Login',
                        detail: response.data?.message,
                        life: 4000
                    });
                }

                errors.value = e.response.data?.errors;
            }

            loginLoading.value = false;
        }
    }
</script>

<template>
    <div class="container">
        <Card>
            <template #title>Pokemon Network</template>
            <template #subtitle>Login Form</template>
            <template #content>
                <form id="login-form"
                      class="form-group"
                      action="/authenticate"
                      method="POST"
                      v-if="mode === 'login'">
                    <InputText type="hidden"
                               name="_token"
                               :value="csrfToken()" />
                    <div class="mb-1">
                        <InputText
                            :class="{ 'input-fluid': true, 'p-invalid': errors['username'] }"
                            type="text"
                            name="username"
                            placeholder="Username"
                            v-model="user.username">
                        </InputText>
                        <small v-if="errors['username']"
                               class="p-error">{{ errors['username'].pop() }}</small>
                    </div>

                    <div class="mb-1">
                        <InputText
                            :class="{ 'input-fluid': true, 'p-invalid': errors['password'] }"
                            type="password"
                            name="password"
                            placeholder="Password"
                            v-model="user.password">
                        </InputText>
                        <small v-if="errors['password']"
                               class="p-error">{{ errors['password'].pop() }}</small>
                    </div>

                    <div class="control-area">
                        <Button
                            label="Register"
                            severity="info"
                            @click.prevent="onRegisterClicked">
                        </Button>

                        <Button
                            class="control"
                            :label="isLogin ? 'Login' : 'Submit'"
                            severity="secondary"
                            :loading="loginLoading"
                            @click.prevent="login">
                        </Button>
                    </div>
                </form>

                <div class="form-group"
                     v-if="mode === 'register'">
                    <RegisterForm @show-login="onShowLogin"
                                  @show-toast="(toast) => emit('show-toast', toast)"/>
                </div>
            </template>
        </Card>
    </div>
</template>

<style scoped>
    .form-group {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        min-width: 700px;
    }
</style>
