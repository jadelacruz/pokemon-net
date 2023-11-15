<script setup>
    import { ref, defineProps, computed } from 'vue';

    import Card from 'primevue/card';
    import Avatar from 'primevue/avatar';
    import Fieldset from 'primevue/fieldset';
    import Divider from 'primevue/divider';
    import PokemonCard from './PokemonCard.vue';

    const props = defineProps({
        trainer : Object,
        pokemons: Array
    });

    const trainer        = ref({ ...props.trainer });
    const trainerFulName = computed(() => [trainer.value.firstName, trainer.value.lastName].join(' '));
    const avatarLabel    = computed(() => {
        const initials = trainerFulName.value.split(' ')
            .map(word => word.charAt(0).toUpperCase())
            .join('');

        return initials.substring(0, 2);
    });
    const pickedPokemons = trainer.value.picks.map(pick => {
        const { pickType, pokemonId } = pick;
        const matched = props.pokemons.find(pokemon => pokemon.id === pokemonId);
        return { pickType, ...matched };
    });

    const favoritePokemons = computed(() => pickedPokemons.filter(pokemon => pokemon.pickType === 'favorite'));
    const likedPokemons    = computed(() => pickedPokemons.filter(pokemon => pokemon.pickType === 'like'));
    const dislikedPokemons = computed(() => pickedPokemons.filter(pokemon => pokemon.pickType === 'dislike'));
</script>

<template>
    <Card :pt="{
        root: { class: 'trainer-card' },
        content: { style: 'display: flex; flex-wrap: wrap; margin-top: 15px;' },
        title : { style: 'text-align: center;' },
        footer: { style: 'display: flex; justify-content: space-evenly;' }
    }">
        <template #content>
            <div class="divider-20">
                <Avatar
                    :pt="{
                        root: { style: 'width: 8rem; height: 8rem; font-size: 4rem;' }
                    }"
                    :label="avatarLabel"
                    size="xlarge"
                    shape="circle" />
                <div class="trainer-details">
                    <hr />
                    <span class="trainer-info">Trainer Name: </span>
                    <span>{{ trainerFulName }}</span> <br />

                    <span class="trainer-info">E-mail: </span>
                    <span>{{ trainer.email }}</span>
                </div>
            </div>

            <Divider layout="vertical" />
            <div class="divider-75">

                <Fieldset :pt="{ root: { style: 'width: 100%' } }"
                          legend="Favorites"
                          :toggleable="true"
                          :collapsed="true">
                    <PokemonCard
                        v-for="pokemon in favoritePokemons"
                        :pokemon="pokemon"/>
                    <p v-if="!favoritePokemons.length">None</p>
                </Fieldset>

                <Fieldset :pt="{ root: { style: 'width: 100%' } }"
                          legend="Likes"
                          :toggleable="true"
                          :collapsed="true">
                    <PokemonCard
                        v-for="pokemon in likedPokemons"
                        :pokemon="pokemon"/>
                    <p v-if="!likedPokemons.length">None</p>
                </Fieldset>

                <Fieldset :pt="{ root: { style: 'width: 100%' } }"
                          legend="Hates"
                          :toggleable="true"
                          :collapsed="true">
                    <PokemonCard
                        v-for="pokemon in dislikedPokemons"
                        :pokemon="pokemon"/>
                    <p v-if="!dislikedPokemons.length">None</p>
                </Fieldset>

            </div>
        </template>
    </Card>
</template>

<style scoped>
    .divider-20 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        width: 20%;
    }

    .divider-75 {
        display: flex;
        width: 75%;
    }


    .trainer-details {
        margin-top: 10px;
        flex-basis: 100%;
        align-self: baseline;
    }

    .trainer-info {
        font-weight: 700;
    }

    .trainer-card {
        flex-grow: 1;
        width: 100%;
        margin: 20px;
    }

    .trainer-name {


    }
</style>
