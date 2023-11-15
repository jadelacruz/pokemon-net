import axios from '../common/axios'

const UserPickRest = {
    get  : () => axios.get('/api/user/pick'),
    store: (userPick) => axios.post('/api/user/pick', userPick)
}

export default UserPickRest;

