import axios from '../common/axios'

const UserRest = {
    get: () => axios.get('/api/user')
}

export default UserRest;

