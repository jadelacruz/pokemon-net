<script setup>
    import { defineEmits, ref } from 'vue';
    import { useRegisterStore } from '../stores/register';
    import RegisterSchema from '../schema/schema.register';

    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import RegisterRest from '../rest/rest.register';

    const emit = defineEmits(['show-login', 'show-toast', ]);
    const { name, username, password, rePassword } = useRegisterStore();
    const register = { name, username, password, rePassword };

    const errors = ref({});

    const submitRegistration = async () => {
        try {
            const validForm = await RegisterSchema.validate(register, { abortEarly: false });
            const response  = await RegisterRest.create(validForm);

            if (response && response.status === 200) emit('show-toast', {
                severity: 'success',
                info    : 'Registration',
                detail  : response.data?.message,
                life    : 5000
            });

            emit('show-login');
        } catch (e) {
            if (e.name === 'ValidationError') {
                errors.value = {};
                e.inner.forEach((value) => errors.value[value.path] = value.errors);
            }

            if (e.name === 'AxiosError') errors.value = e.response.data?.errors;
        }
    };
</script>

<template>
    <form>
        <div class="mb-1">
            <InputText
                id="name"
                :class="{ 'input-fluid': true, 'p-invalid': errors['name'] }"
                type="text"
                placeholder="Name"
                v-model="register.name">
            </InputText>
        <small v-if="errors['name']"
               class="p-error">{{ errors['name'].pop() }}</small>
        </div>

        <div class="mb-1">
             <InputText
                 id="username"
                 :class="{ 'input-fluid': true, 'p-invalid': errors['username'] }"
                 type="text"
                 placeholder="Username"
                 v-model="register.username"
                 aria-describedby="text-error">
            </InputText>
            <small v-if="errors['username']"
                   class="p-error">{{ errors['username'].pop() }}</small>

        </div>

        <div class="mb-1">
            <InputText
                id="password"
                :class="{ 'input-fluid': true, 'p-invalid': errors['password'] }"
                type="password"
                placeholder="Password"
                v-model="register.password">
            </InputText>
            <small v-if="errors['password']"
                   class="p-error">{{ errors['password'].pop() }}</small>
        </div>

        <div class="mb-1">
             <InputText
                 id="rePassword"
                 :class="{ 'input-fluid': true, 'p-invalid': errors['rePassword'] }"
                 type="password"
                 placeholder="Retype Password"
                 v-model="register.rePassword">
            </InputText>
            <small v-if="errors['rePassword']"
                   class="p-error">{{ errors['rePassword'].pop() }}</small>
        </div>

        <div class="control-area">
            <Button
                class="control"
                label="Cancel"
                severity="warning"
                @click.prevent="emit('show-login')">
            </Button>

            <Button
                class="control"
                label="Submit"
                severity="secondary"
                @click.prevent="submitRegistration">
            </Button>
        </div>

    </form>
</template>

<style scoped>
</style>
