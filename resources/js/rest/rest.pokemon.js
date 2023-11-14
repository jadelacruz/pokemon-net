import axios from 'axios';

const PokemonRest = {
    list: (offset = 0, limit = 10) => {
        return axios.get('/api/pokemon', {
            params: {
                offset,
                limit
            }
        });
    }
};

export default PokemonRest;

