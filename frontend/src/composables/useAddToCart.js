// src/composables/useAddToCart.js
import { useCartStore } from '@/stores/cart';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export function useAddToCart() {
  const cartStore = useCartStore();
  const addingToCart = ref(false);
  const addToCartError = ref(null);
  const addToCartSuccess = ref(null);
  const router = useRouter();

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

          // Redirect or perform other actions after successful login
          if (router && error.status === 401) {
              if (confirm("You need to login first to continue, go to login?")) {
                  router.push("/login");
              }
          }
      }
  };

  return {
      handleAddToCart,
      addingToCart,
      addToCartError,
      addToCartSuccess
  };
}