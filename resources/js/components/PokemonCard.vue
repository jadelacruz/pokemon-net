<script>
    import { defineComponent, ref, computed } from 'vue';
    import Card from 'primevue/card';
    import Button from 'primevue/button';

    export default defineComponent({
        components: {
            Card,
            Button
        },
        props: {
            pokemon: Object
        },
        setup(props) {
            const pokemon = ref({ ...props.pokemon })
            const sprite  = computed(() => pokemon.value.sprites.other.dream_world.front_default);
            const pokemonNameTitleCased = computed(() => pokemon.value.name.replace(/\b\w/g, match => match.toUpperCase()))

            return {
                pokemon,
                sprite,
                pokemonNameTitleCased
            };
        },
        methods: {


        }
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
                icon="pi pi-heart"
                severity="primary"></Button>

            <Button
                label="Dislike"
                icon="pi pi-thumbs-down"
                severity="danger"></Button>
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
