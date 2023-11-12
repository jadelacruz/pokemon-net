<script setup>
    import { defineEmits } from 'vue';
    import { useRegisterStore } from '../stores/register';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import RegisterRest from '../rest/rest.register';

    const emit = defineEmits(['cancel-registration']);

    const { name, username, password, rePassword } = useRegisterStore();
    const register = { name, username, password, rePassword };


    const submitRegistration = async () => {
        const response = await RegisterRest.create();
        console.log(response);
    };
    const cancelRegistration = () => {
        emit('cancel-registration');
    };

</script>

<template>
    <InputText
        class="input-fluid"
        type="text"
        placeholder="Name"
        v-model="register.name">
    </InputText>

    <InputText
        class="input-fluid"
        type="text"
        placeholder="Username"
        v-model="register.username">
    </InputText>

    <InputText
        class="input-fluid"
        type="password"
        placeholder="Password"
        v-model="register.password">
    </InputText>

    <InputText
        class="input-fluid"
        type="password"
        placeholder="Retype Password"
        v-model="register.rePassword">
    </InputText>

    <div class="control-area">
        <Button
            class="control"
            label="Cancel"
            severity="warning"
            @click="cancelRegistration">
        </Button>

        <Button
            class="control"
            label="Submit"
            severity="secondary"
            @click="submitRegistration">
        </Button>
    </div>
</template>

<style scoped>
</style>
