import { useCartStore } from '@/stores/cart';
import { ref } from 'vue';
import { useFetchCart } from './useFetchCart';

export function useRemoveToCart() {
  const cartStore = useCartStore();
    const fetchCart = useFetchCart();

  const removingToCart = ref(false);
  const removeToCartError = ref(null);
  const removeToCartSuccess = ref(null);

  const handleRemoveToCart = async (product) => {
    removingToCart.value = true;
    removeToCartError.value = null;
    removeToCartSuccess.value = null;

      try {
          await cartStore.removeToCart(product);
          removingToCart.value = false;
          removeToCartSuccess.value = true;
          // Optionally provide feedback to the user (e.g., a toast notification)
          fetchCart.fetchCartRefresh();
      } catch (error) {
        removeToCartError.value = error.message || 'Failed to remove to cart.';
        removingToCart.value = false;

          // Optionally handle the error further in the component
          console.error('Error removing to cart:', error);
      }
  };

  return {
        handleRemoveToCart,
        removingToCart,
        removeToCartError,
        removeToCartSuccess
  };
}