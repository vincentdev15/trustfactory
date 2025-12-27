import axios from 'axios';

const auth = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
});

export default auth;
