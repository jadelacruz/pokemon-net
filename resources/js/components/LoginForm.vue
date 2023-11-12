<script setup>
    import { ref, computed } from 'vue';
    import Card from 'primevue/card';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import RegisterForm from './RegisterForm.vue';
    import { useUserStore } from '../stores/user';

    const { name, username, password } = useUserStore();

    const mode = ref('login');
    const user = { name, username, password };
    const isLogin = computed(() => mode.value === 'login');

    const onRegisterClicked = () => {
        mode.value = (mode.value === 'login') ? 'register' : 'login';
    }

    const onRegisterCanceled = () => {
        mode.value = 'login';
    }
</script>

<template>
    <div class="container">
        <Card>
            <template #title>Pokemon Network</template>
            <template #subtitle>Login Form</template>
            <template #content>
                <div class="form-group"
                     v-if="mode === 'login'">
                    <InputText
                        class="input-fluid"
                        type="text"
                        placeholder="Username"
                        v-model="user.username">
                    </InputText>

                    <InputText
                        class="input-fluid"
                        type="password"
                        placeholder="Password"
                        v-model="user.password">
                    </InputText>

                    <div class="control-area">
                        <Button
                            class="control"
                            label="Register"
                            severity="info"
                            @click="onRegisterClicked">
                        </Button>

                        <Button
                            class="control"
                            :label="isLogin ? 'Login' : 'Submit'"
                            severity="secondary">
                        </Button>
                    </div>
                </div>

                <div class="form-group"
                     v-if="mode === 'register'">
                    <RegisterForm @cancel-registration="onRegisterCanceled"/>
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
