import { defineStore } from 'pinia';
import { useFetchProducts } from '@/composables/useFetchProducts';

export const useProductsStore = defineStore('products', () => {
  const { products, loading, error } = useFetchProducts();
  return { products, loading, error };
});