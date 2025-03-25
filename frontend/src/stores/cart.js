import { defineStore } from 'pinia';
import { useFetchCart } from '@/composables/useFetchCart';
import axios from 'axios';
import { watch, computed } from 'vue';

export const useCartStore = defineStore('cart', () => {
  const { cart: fetchedCart, loading: fetchLoading, error: fetchError } = useFetchCart();

  const state = () => ({
    cartItems: fetchedCart.value,
    loading: false,
    error: null
  });

  const cart = computed(() => state().cartItems);
  const loading = computed(() => state().loading || fetchLoading.value);
  const error = computed(() => state().error || fetchError.value);

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

      if (response.data) {
        //do something
      }

      state().loading = false;
      state().success = true;
    } catch (err) {
      state().error = err.response?.data?.message || 'Failed to add product to cart';
      state().loading = false;
      throw err;
    }
  }

  return { cart, loading, error, addToCart };
});