<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router'
// import MenuBar from 'primevue/menubar';

const router = useRouter();
const items = ref([
    {
        label: 'Home',
        icon: 'pi pi-home'
    },
    {
        label: 'About',
        icon: 'pi pi-star',
        command: () => router.push('/about')
    }
]);
</script>

<template>
<!--    <div class="card">-->
<!--        <MenuBar :model="items" />-->
<!--    </div>-->

    <RouterView/>
</template>
