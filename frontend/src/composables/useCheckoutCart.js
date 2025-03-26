// src/composables/useCheckoutCart.js
import { useCartStore } from '@/stores/cart';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export function useCheckoutCart() {

    const cartStore = useCartStore();
    const checkingOut = ref(false);
    const checkoutError = ref(null);
    const checkoutSuccess = ref(null);
    const router = useRouter();

    const handleCheckout = async () => {
        checkingOut.value = true;
        checkoutError.value = null;
        checkoutSuccess.value = null;

        try {
            await cartStore.doCheckout();
            checkingOut.value = false;
            checkoutSuccess.value = true;

            if (router) {
                router.push('/order-confirmation');
            }
        } catch (error) {
            checkoutError.value = error.message || 'Failed to process checkout.';
            checkingOut.value = false;

            // Optionally handle the error further in the component
            console.error('Error during checkout:', error);

            // Redirect or perform other actions based on the error status
            if (router && error.response?.status === 401) {
                if (confirm("You need to login first to checkout, go to login?")) {
                    router.push("/login");
                }
            } else if (router && error.response?.status === 400) {
                // Handle specific checkout errors, e.g., invalid address
                // You might want to display a more specific error message
                console.error('Checkout validation error:', error.response.data);
                // Optionally set a more specific error message based on error.response.data
                checkoutError.value = error.response.data.message || 'Invalid checkout information.';
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