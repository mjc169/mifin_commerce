import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('authToken') || null,
        user: null,
        loading: false,
        error: null,
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        async login(credentials) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post('/api/login', credentials);
                this.token = response.data.token;
                localStorage.setItem('authToken', this.token);

                // Assuming your login response also includes user data:
                //this.user = response.data.user;

                this.loading = false;
            } catch (error) {
                this.error = error.response?.data?.message || 'Login failed';
                this.loading = false;
                throw error; // re-throw the error so the component can handle it too.
            }
        },
        async logout() {
            this.loading = true;
            try {
                await axios.post('/api/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.token = null;
                this.user = null;
                localStorage.removeItem('authToken'); // or sessionStorage
                this.loading = false;
            } catch (error) {

                this.error = error.response?.data?.message || 'Logout failed';
                this.loading = false;
                throw error;
            }
        },
        async fetchUser() {
            this.loading = true;
            try {
                const response = await axios.get('/api/userInformation', {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.user = response.data;
                this.loading = false;
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to fetch user';
                this.loading = false;
                throw error;
            }
        },
        clearError() {
            this.error = null;
        },
    },
});