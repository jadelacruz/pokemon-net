<script setup>
    import {ref, onMounted} from 'vue';

    import Panel from 'primevue/panel';
    import PokemonCard from '../components/PokemonCard.vue';
    import PokemonRest from '../rest/rest.pokemon';

    const pokemons = ref([]);

    onMounted(async () => {
        const response = await PokemonRest.list(0, 15);
        pokemons.value = response.data;
    });
</script>

<template>
    <Panel header="Pokemon" :pt="{ root: { style: 'margin-top: 10px;' } }">
        <div class="poke-container">
            <PokemonCard
                v-for="pokemon in pokemons"
                :key="pokemon.id"
                :pokemon="pokemon"/>
        </div>
    </Panel>
</template>

<style scoped>
    .poke-container {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
</style>
