import axios from '../common/axios';

const RegisterRest = {
    create: (user) => axios.post('/api/user', user)
};

export default RegisterRest;
