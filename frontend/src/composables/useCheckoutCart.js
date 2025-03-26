import { useCartStore } from '@/stores/cart';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export function useCheckoutCart() {
  const cartStore = useCartStore();
  const checkingOut = ref(false);
  const checkoutError = ref(null);
  const checkoutSuccess = ref(null);
  const router = useRouter();

  const handleCheckout = async (formData) => { // Accept formData as an argument
    checkingOut.value = true;
    checkoutError.value = null;
    checkoutSuccess.value = null;

    try {
      await cartStore.doCheckout(formData); // Pass formData to doCheckout
      checkingOut.value = false;
      checkoutSuccess.value = true;

      if (router) {
        router.push('/myCart');
        alert("Checkout successful, you have received your receipt in your email.");
      }
    } catch (error) {
      checkoutError.value = error.message || 'Failed to process checkout.';
      checkingOut.value = false;

      console.error('Error during checkout:', error);

      if (router && error.response?.status === 401) {
        if (confirm('You need to login first to checkout, go to login?')) {
          router.push('/login');
        }
      } else if (error.response?.status === 422) {
        // Validation errors from Laravel
        const validationErrors = error.response.data.errors;
        let errorMessage = 'Validation errors:\n';

        for (const field in validationErrors) {
          errorMessage += `${validationErrors[field].join(', ')}\n`;
        }
        alert(errorMessage);
      } else if (error.response?.status === 500) {
        // Internal server error
        const errorMessage  = error.response.data.error || 'An internal server error occurred. Please try again later.';
        alert(errorMessage);
      }
    }
  };

  return {
    handleCheckout,
    checkingOut,
    checkoutError,
    checkoutSuccess,
  };
}