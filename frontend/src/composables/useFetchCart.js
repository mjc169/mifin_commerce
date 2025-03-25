import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

export function useFetchCart() {
    const cart = ref([]);
    const loading = ref(false);
    const error = ref(null);
  
    const fetchCart = async () => {
      loading.value = true;
      error.value = null;
      try {
        const token = localStorage.getItem('authToken');

        const response = await axios.get('/api/cart', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        cart.value = response.data;
      } catch (err) {
        error.value = err;
      } finally {
        loading.value = false;
      }
    };
  
    onMounted(fetchCart); // Fetch cart when the store is mounted
    
    const route = useRoute();
    watch(
      () => route.path, // Watch the route path
      (newPath) => {
        if (newPath === '/myCart') {
          fetchCart();
        }
      }
    );
    return { cart, loading, error };
}