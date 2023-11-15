<script setup>
    import { ref, onMounted } from 'vue';

    import Panel from 'primevue/panel';
    import UserRest from '../rest/rest.user';
    import TrainerCard from '../components/TrainerCard.vue';

    const trainers  = ref([]);
    const pokemons  = ref([]);
    const paginator = ref({
        rows: 5,
        page: 1,
        totalRecords: 0
    });

    const pageChangeHandler = async ({ page }) => {
        await getTrainers(page);
    }

    const getTrainers = async (page) => {
        const response = await UserRest.list(page);
        trainers.value =  response.data?.trainers;
        pokemons.value = response.data?.pokemons;
        paginator.value.totalRecords = response.data?.totalTrainers;
    }

    onMounted(async () => {
        await getTrainers(0)
    });
</script>

<template>
    <Panel header="Trainers" :pt="{ root: { style: 'margin-top: 10px;' } }">
        <div class="trainer-container">
            <TrainerCard
                v-for="trainer in trainers"
                :key="trainer.id"
                :trainer="trainer"
                :pokemons="pokemons" />
        </div>
        <Paginator
            :rows="paginator.rows"
            :total-records="paginator.totalRecords"
            @page="pageChangeHandler" />
    </Panel>
</template>

<style scoped>
    .trainer-container {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
</style>
