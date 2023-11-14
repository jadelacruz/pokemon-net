import axios from '../common/axios';

const AuthRest = {
    attempt: (user) => axios.post('/api/auth', user),
    signOut: () => axios.post('/api/logout')
};

export default AuthRest;
