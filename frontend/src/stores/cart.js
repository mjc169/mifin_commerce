import { defineStore } from 'pinia';
import { useFetchCart } from '@/composables/useFetchCart';
import axios from 'axios';
import { watch, computed, ref } from 'vue';

export const useCartStore = defineStore('cart', () => {
  const {
      cart: fetchedCart,
      loading: fetchLoading,
      error: fetchError,
      fetchCartRefresh
  } = useFetchCart();

  const state = () => ({
      cartItems: fetchedCart.value,
      loading: false,
      error: null
  });

  const cart = ref([]);
  const loading = computed(() => fetchLoading.value); 
  const error = computed(() => fetchError.value);  

  // Watch for changes in fetchedCart and update cartItems
  watch(fetchedCart, (newCart) => {
    cart.value = newCart || []; // Update local cartItems when fetchedCart changes
  }, { deep: true }); // Use deep watch if your cart items are complex objects

    async function addToCart(product) {
        state().loading = true;
        state().error = null;
        try {
            const token = localStorage.getItem('authToken');
            const response = await axios.post(`/api/cart/add/${product.id}`, {}, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            });

            fetchCartRefresh(); // Refresh the cart after adding

            state().loading = false;
            state().success = true;
        } catch (err) {
            state().error = err.response?.data?.message || 'Failed to add product to cart';
            state().loading = false;
            throw err;
        }
    }

    async function removeToCart(product) {
        state().loading = true;
        state().error = null;
        try {
            const token = localStorage.getItem('authToken');
            await axios.post(`/api/cart/remove/${product.id}`, {}, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            });

            fetchCartRefresh(); // Refresh the cart after adding

            state().loading = false;
            state().success = true;
        } catch (err) {
            state().error = err.response?.data?.message || 'Failed to add product to cart';
            state().loading = false;
            throw err;
        }
    }

    async function doCheckout() {
      state().checkoutLoading = true;
      state().checkoutError = null;
      state().checkoutSuccess = false;
      try {
          const token = localStorage.getItem('authToken');
          const response = await axios.post('/api/checkout', {}, {
              headers: {
                  Authorization: `Bearer ${token}`,
              }
          });

          if (response.data) {
              // Handle successful checkout, e.g., clear the cart
              //state().cartItems = [];
              fetchCartRefresh(); // Refresh the fetched cart to reflect the empty state
              state().checkoutSuccess = true;
          }

          state().checkoutLoading = false;
      } catch (err) {
          state().checkoutError = err.response?.data?.message || 'Failed to process checkout';
          state().checkoutLoading = false;
          throw err;
      }
  }

  return {
    cart,
      loading,
      error,
      addToCart,
      removeToCart
  };
});