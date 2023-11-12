import axios from 'axios';

const AuthRest = {
    attempt: (user) => axios.post('/api/auth', user)
};

export default AuthRest;
