<script setup>
    import { ref, computed, onMounted } from 'vue';
    import { RouterView, useRouter } from 'vue-router'

    import AuthRest from '../rest/rest.auth';
    import UserRest from '../rest/rest.user';
    import Menubar from 'primevue/menubar';
    import pokeballImgUrl from '../../../public/img/pokeball.svg';

    const router       = useRouter()
    const initialRoute = '/pokemon';
    const user         = ref(null);

    const navbarItems  = ref([
        {
            label: 'Pokemon',
            command: () => router.push({ name: 'pokemon' })
        },
        {
            label: 'Trainers',
            command: () => router.push({ name: 'trainer' })
        }
    ]);

    const userFullName = computed(() => [user.value?.firstName, user.value?.lastName].join(' '))
    const userAvatar   = computed(() => {
        const initials = userFullName.value.split(' ')
            .map(word => word.charAt(0).toUpperCase())
            .join('');

        return initials.substring(0, 2);
    })

    const getUserDetails = async () => {
        const response = await UserRest.get();
        user.value     = response.data;
        sessionStorage.setItem('user', JSON.stringify(user.value));
    }

    const signOut = async () => {
        try {
            await AuthRest.signOut();
            location.replace('/logout');
        } catch (e) {
            console.warn(e);
        }
    }

    onMounted(() => {
        router.push(initialRoute);
        getUserDetails();
    });

</script>

<template>
    <main>
        <Menubar :model="navbarItems" :pt="{ root: { style: 'background: white' } }">
            <template #start>
                <a href="/dashboard">
                    <img class="nav-icon"
                         alt="pokeball.svg"
                         :src="pokeballImgUrl" />
                </a>
            </template>
            <template #end>
                <a href="#" @click="signOut">Logout</a>
                <Avatar
                    :label="userAvatar"
                    class="avatar"
                    shape="circle" />
            </template>
        </Menubar>

        <RouterView />
    </main>
</template>

<style scoped>
    .nav-icon {
        border: 1px solid #000000;
        margin-right: 10px;
        height: 30px;
        width: 30px;
    }

    .avatar {
        margin-left: 10px;
    }
</style>
