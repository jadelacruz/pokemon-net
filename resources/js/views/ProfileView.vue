<script setup>
    import { useRouter } from 'vue-router';
    import Panel from 'primevue/panel';
    import RegisterForm from '../components/RegisterForm.vue'
    import UserSession from '../common/user';
    import UserRest from '../rest/rest.user';

    const router = useRouter();
    const updateUserSession = async () => {
        alert('Profile was update');
        const response = await UserRest.get();
        sessionStorage.setItem('user', JSON.stringify(response.data));
        await router.push({ name: 'pokemon' })
    }
</script>

<template>
    <Panel header="Profile Update" :pt="{ root: { style: 'margin-top: 10px;' } }">
        <div class="profile-container">
            <RegisterForm
                :user="UserSession()"
                :submit="UserRest.update"
                @show-toast="updateUserSession" />
        </div>
    </Panel>
</template>


<style scoped>
    .profile-container {


    }
</style>
