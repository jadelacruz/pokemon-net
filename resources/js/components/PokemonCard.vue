<script setup>
    import { defineEmits, defineProps, ref, computed } from 'vue';
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import UserPickRest from '../rest/rest.user-pick';

    const emit  = defineEmits(['show-toast']);
    const props = defineProps({
        pokemon: Object,
        userPicks: Array,
        showPicker: Boolean
    });

    const pokemon = ref({ ...props.pokemon });
    const picks   = ref(props.userPicks ? [ ...props.userPicks ] : []);
    const picking = ref(false);

    const sprite  = computed(() => pokemon.value.sprites.other.dream_world.front_default);
    const favoriteIcon = computed(() => iconDeterminer('pi pi-heart', 'favorite'));
    const likeIcon     = computed(() => iconDeterminer('pi pi-thumbs-up', 'like'));
    const dislikeIcon  = computed(() => iconDeterminer('pi pi-thumbs-down', 'dislike'));
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

    const pick = async (pokemonId, pickType) => {
        try {
            if (picking.value) return;
            picking.value = true;
            const response = await UserPickRest.store({
                pokemonId,
                pickType
            });

            picks.value = response.data;
        } catch (e) {
            if (e.name === 'AxiosError') {
                const {response} = e;
                emit('show-toast', {
                    severity: 'warn',
                    info: 'Warning',
                    detail: response.data?.message,
                    life: 4000
                });
            }
        }

        setTimeout(() => { picking.value = false }, 1000);
    };
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
        <template #footer v-if="showPicker">
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
