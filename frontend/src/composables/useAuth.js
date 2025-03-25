import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';

export function useAuth() {
  const authStore = useAuthStore();
  const router = useRouter(); 

  const handleLogin = async (credentials, redirectRoute = '/') => {
    try {
      await authStore.login(credentials);
      // Redirect or perform other actions after successful login
      if (router) {
        router.push(redirectRoute);
      }
    } catch (error) {
      // Error is handled by the store, but you can add more logic here if needed.
      console.error('Login failed in composable:', error);
      throw error;
    }
  };

  const handleLogout = async (redirectRoute = '/login') => {
    try {
      await authStore.logout();
      // Redirect after successful logout
       if (router) {
        router.push(redirectRoute);
      }
    } catch (error) {
      console.error('Logout failed in composable:', error);
      throw error;
    }
  };

  const fetchUser = async () => {
    try {
      await authStore.fetchUser();
    } catch (error) {
      console.error('Failed to fetch user in composable:', error);
      throw error;
    }
  };

  const clearAuthError = () => {
    authStore.clearError();
  }

  return {
    handleLogin,
    handleLogout,
    fetchUser,
    clearAuthError,
    isAuthenticated: authStore.isAuthenticated,
    token: authStore.token,
    user: authStore.user,
    loading: authStore.loading,
    error: authStore.error,
  };
}