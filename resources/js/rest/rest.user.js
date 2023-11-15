import axios from '../common/axios'

const UserRest = {
    get : () => axios.get('/api/user'),
    list: (page) => axios.get('/api/users', {
        params: { page }
    }),
    update: (user) => axios.put('/api/user', user)
}

export default UserRest;

