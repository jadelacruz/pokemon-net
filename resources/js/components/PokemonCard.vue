<script>
    import { defineComponent, ref, computed } from 'vue';
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import UserPickRest from '../rest/rest.user-pick';

    export default defineComponent({
        components: {
            Card,
            Button
        },
        props: {
            pokemon: Object,
            userPicks: Array
        },
        setup(props) {
            const pokemon = ref({ ...props.pokemon });
            const picks   = ref([ ...props.userPicks ]);
            const picking = ref(false);

            const sprite  = computed(() => pokemon.value.sprites.other.dream_world.front_default);
            const pokemonNameTitleCased = computed(() => pokemon.value.name.replace(/\b\w/g, match => match.toUpperCase()))
            const iconDeterminer = (icon, type) => {
                const match = picks.value.find(
                    pick => (pick.pokemonId === pokemon.value.id && pick.pickType === type)
                );

                if (match) {
                    return icon + '-fill';
                }

                return icon;
            }

            const favoriteIcon = computed(() => iconDeterminer('pi pi-heart', 'favorite'));
            const likeIcon     = computed(() => iconDeterminer('pi pi-thumbs-up', 'like'));
            const dislikeIcon  = computed(() => iconDeterminer('pi pi-thumbs-down', 'dislike'));

            return {
                pokemon,
                picks,
                picking,
                sprite,
                pokemonNameTitleCased,
                favoriteIcon,
                likeIcon,
                dislikeIcon
            };
        },
        methods: {
            async pick(pokemonId, pickType) {
                try {
                    if (this.picking) return;
                    this.picking = true;
                    const response = await UserPickRest.store({
                        pokemonId,
                        pickType
                    });

                    this.picking = false;
                    this.picks   = response.data;
                } catch (e) {
                    console.error(e);
                }

            }
        },
    });
</script>

<template>
    <Card :pt="{
        root  : { class: 'poke-card' },
        header: { style: 'display: flex; justify-content: center;' },
        title : { style: 'text-align: center;' },
        footer: { style: 'display: flex; justify-content: space-evenly;' }
    }">
        <template #header>
            <a :href="sprite" target="_blank">
                <img class="pokemon-img"
                     :alt="pokemon.name"
                     :src="sprite"/>
            </a>
        </template>
        <template #title>{{ pokemonNameTitleCased }}</template>
        <template #footer>
            <Button
                label="Favorite"
                :icon="favoriteIcon"
                severity="primary"
                @click="pick(pokemon.id, 'favorite')"></Button>

            <Button
                label="Like"
                :icon="likeIcon"
                severity="success"
                @click="pick(pokemon.id, 'like')"></Button>

            <Button
                label="Dislike"
                :icon="dislikeIcon"
                severity="danger"
                @click="pick(pokemon.id, 'dislike')"></Button>
        </template>
    </Card>
</template>

<style scoped>
    .pokemon-img {
        border: 1px solid #000000;
        height: 200px;
        width: 200px;
        margin-top: 20px;
        text-align: center;
    }

    .poke-card {
        flex-grow: 1;
        margin: 20px;
        width: 400px;
        max-width: 400px;
    }

    .poke-card-title {
        text-align: center;

    }
</style>
