import { defineStore } from 'pinia';
import { useFetchCart } from '@/composables/useFetchCart';

export const useCartStore = defineStore('cart', () => {
  const { cart, loading, error } = useFetchCart();
  return { cart, loading, error };
});