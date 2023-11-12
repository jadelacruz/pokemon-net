<script setup>
    import LoginForm from '../components/LoginForm.vue';
    import { useToast } from 'primevue/usetoast';
    import Toast from 'primevue/toast';

    const toast = useToast();
</script>

<template>
  <main>
      <Toast position="bottom-center" />
      <LoginForm @show-toast="(config) => toast.add(config)" />
  </main>
</template>
