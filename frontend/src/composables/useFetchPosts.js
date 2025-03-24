import { ref, onMounted } from 'vue';
import axios from 'axios';

export function useFetchPosts() {
    const posts = ref([]);
    const loading = ref(false);
    const error = ref(null);
  
    const fetchPosts = async () => {
      loading.value = true;
      error.value = null;
      try {
        const response = await axios.get('/api/products');
        posts.value = response.data;
      } catch (err) {
        error.value = err;
      } finally {
        loading.value = false;
      }
    };
  
    onMounted(fetchPosts); // Fetch posts when the store is mounted
  
    return { posts, loading, error };
}