<script setup>
    import { ref, defineProps } from 'vue';
    import { useRegisterStore } from '../stores/register';

    import { handleValidationError, handleAxiosError } from '../common/utility';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';

    const emit     = defineEmits([ 'show-toast', 'cancel-registration' ]);
    const props    = defineProps(['user', 'submit']);
    const register = (props.user) ? { ...props.user } : { ...useRegisterStore() };
    const errors   = ref({});
    const { schema } = useRegisterStore();

    const submitRegistration = async () => {
        try {
            const validForm = await schema.validate(register, { abortEarly: false });
            const response  = await props.submit({
                firstName : validForm.firstName,
                lastName  : validForm.lastName,
                email     : validForm.email,
                password  : validForm.password,
                rePassword: validForm.rePassword
            });

            if (response && response.status === 200) {
                emit('show-toast', {
                    severity: 'success',
                    info    : 'Submit',
                    detail  : response.data?.message,
                    life    : 5000
                });

                emit('cancel-registration');
            }
        } catch (e) {
            handleValidationError(errors, e);
            handleAxiosError(errors, e);
        }
    };
</script>

<template>
    <form>
        <div class="mb-1">
            <InputText
                id="firstName"
                :class="{ 'input-fluid': true, 'p-invalid': errors.firstName?.length }"
                type="text"
                placeholder="First Name"
                v-model="register.firstName">
            </InputText>
            <small v-if="errors.firstName?.length"
                   class="p-error">{{ errors.firstName[errors.firstName.length -1] }}</small>
        </div>

        <div class="mb-1">
            <InputText
                id="lastName"
                :class="{ 'input-fluid': true, 'p-invalid': errors.lastName?.length }"
                type="text"
                placeholder="Last Name"
                v-model="register.lastName">
            </InputText>
            <small v-if="errors.lastName?.length"
                   class="p-error">{{ errors.lastName[errors.lastName.length -1] }}</small>
        </div>

        <div class="mb-1">
             <InputText
                 id="email"
                 :class="{ 'input-fluid': true, 'p-invalid': errors.email?.length }"
                 type="text"
                 placeholder="Email Address"
                 v-model="register.email"
                 aria-describedby="text-error">
            </InputText>
            <small v-if="errors.email?.length"
                   class="p-error">{{ errors.email[errors.email.length -1] }}</small>
        </div>

        <div class="mb-1">
            <InputText
                id="password"
                :class="{ 'input-fluid': true, 'p-invalid': (errors.password?.length || errors.rePassword?.length) }"
                type="password"
                placeholder="Password"
                v-model="register.password">
            </InputText>
            <small v-if="errors.password?.length"
                   class="p-error">{{ errors.password[errors.password.length -1] }}</small>
        </div>

        <div class="mb-1">
             <InputText
                 id="rePassword"
                 :class="{ 'input-fluid': true, 'p-invalid': errors.rePassword?.length }"
                 type="password"
                 placeholder="Retype Password"
                 v-model="register.rePassword">
            </InputText>
            <small v-if="errors.rePassword?.length"
                   class="p-error">{{ errors.rePassword[errors.rePassword.length -1] }}</small>
        </div>

        <div class="control-area">
            <Button
                class="control"
                label="Cancel"
                severity="warning"
                @click.prevent="emit('cancel-registration')">
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
