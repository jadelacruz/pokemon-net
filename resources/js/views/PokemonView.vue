<script setup>
    import { ref, onMounted, onBeforeMount } from 'vue';

    import { isAtBottom } from '../common/utility';
    import Panel from 'primevue/panel';
    import PokemonCard from '../components/PokemonCard.vue';
    import PokemonRest from '../rest/rest.pokemon';

    const pokemons        = ref([]);
    const isAddingPokemon = ref(false);
    const page            = ref(0);
    const limit           = ref(15)
    const scrollEventListener = () => {
        if (isAtBottom() && isAddingPokemon.value === false) {
            addPokemon();
        }
    }

    const addPokemon = async () => {
        isAddingPokemon.value = true;
        const response = await PokemonRest.list(page.value, limit.value);
        pokemons.value = [...pokemons.value, ...response.data];
        page.value     += limit.value;
        isAddingPokemon.value = false;
    }

    onMounted(async () => {
        window.onscroll = scrollEventListener;
        await addPokemon();
    });

    onBeforeMount(() => {
        window.onscroll = null;
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
