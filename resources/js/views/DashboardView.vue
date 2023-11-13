<script setup>
    import { ref, onMounted } from 'vue';
    import { RouterView, useRouter } from 'vue-router'
    import Menubar from 'primevue/menubar';

    const router       = useRouter()
    const initialRoute = '/pokemon';
    const navbarItems  = ref([
        {
            label: 'Pokemon',
            command: () => router.push('/pokemon')
        },
        {
            label: 'Trainers',
            command: () => router.push('/trainer')
        }
    ]);

    onMounted(() => {
        router.push(initialRoute);
    });

</script>

<template>
    <main>
        <Menubar :model="navbarItems">
            <template #start>
                <a href="/dashboard">
                    <img class="nav-icon"
                         alt="pokeball.svg"
                         src="/img/pokeball.svg" />
                </a>
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
</style>
