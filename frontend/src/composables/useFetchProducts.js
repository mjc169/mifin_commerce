import { ref, onMounted } from 'vue';
import axios from 'axios';

export function useFetchProducts() {
    const products = ref([]);
    const loading = ref(false);
    const error = ref(null);
  
    const fetchProducts = async () => {
      loading.value = true;
      error.value = null;
      try {
        const response = await axios.get('/api/products');
        products.value = response.data;
      } catch (err) {
        error.value = err;
      } finally {
        loading.value = false;
      }
    };
  
    onMounted(fetchProducts); // Fetch products when the store is mounted
  
    return { products, loading, error };
}