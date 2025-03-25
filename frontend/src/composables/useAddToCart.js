// src/composables/useAddToCart.js
import { useCartStore } from '@/stores/cart';
import { ref } from 'vue';

export function useAddToCart() {
  const cartStore = useCartStore();
  const addingToCart = ref(false);
  const addToCartError = ref(null);
  const addToCartSuccess = ref(null);

  const handleAddToCart = async (product) => {
    addingToCart.value = true;
    addToCartError.value = null;
    addToCartSuccess.value = null;
    
    try {
      await cartStore.addToCart(product);
      addingToCart.value = false;
      addToCartSuccess.value = true;
      // Optionally provide feedback to the user (e.g., a toast notification)
    } catch (error) {
      addToCartError.value = error.message || 'Failed to add to cart.';
      addingToCart.value = false;
      // Optionally handle the error further in the component
      console.error('Error adding to cart:', error);
    }
  };

  return {
    handleAddToCart,
    addingToCart,
    addToCartError,
    addToCartSuccess
  };
}