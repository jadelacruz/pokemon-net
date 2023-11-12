<script setup>
    import { ref } from 'vue';
    import { useToast } from 'primevue/usetoast';
    import LoginForm from '../components/LoginForm.vue';
    import Toast from 'primevue/toast';
    import RegisterForm from '../components/RegisterForm.vue';

    const modeEnum = Object.freeze({ login: 'login', register: 'register' });
    const toast    = useToast();
    const mode     = ref(modeEnum.login);

    const handleToastEmit      = (config) => toast.add(config);
    const showRegistrationForm = () => mode.value = modeEnum.register;
    const showLoginForm        = () => mode.value = modeEnum.login;
</script>

<template>
    <div class="container">
        <Toast position="bottom-center"/>
        <Card>
            <template #title>Pokemon Network</template>
            <template #subtitle>Login Form</template>
            <template #content>
                <div class="form-group"
                     v-if="mode === modeEnum.login">
                    <LoginForm
                        @show-toast="handleToastEmit"
                        @show-register="showRegistrationForm"/>
                </div>

                <div class="form-group"
                     v-if="mode === modeEnum.register">
                    <RegisterForm
                        @show-toast="handleToastEmit"
                        @cancel-registration="showLoginForm"/>
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
