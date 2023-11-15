<script setup>
    import { ref, onMounted, onBeforeMount, defineProps } from 'vue';

    import { isAtBottom } from '../common/utility';
    import Panel from 'primevue/panel';
    import PokemonCard from '../components/PokemonCard.vue';
    import PokemonRest from '../rest/rest.pokemon';
    import UserPickRest from "../rest/rest.user-pick";

    const pokemons        = ref([]);
    const userPicks       = ref([]);
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
        page.value    += limit.value;
        isAddingPokemon.value = false;
    }

    const getUserPokemonPicks = async () => {
        const response = await UserPickRest.get();
        userPicks.value = response.data;
    }

    onMounted(async () => {
        try {
            window.onscroll = scrollEventListener;
            await Promise.all([
                addPokemon(),
                getUserPokemonPicks()
            ]);

        } catch (e) {
            console.error(e);
        }
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
                :pokemon="pokemon"
                :user-picks="userPicks" />
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
