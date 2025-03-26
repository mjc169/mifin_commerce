<template>
  <div class="product">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">
          Products
          <small class="text-muted"
            >(Total of {{ productCount }} products)</small
          >
        </h4>
      </div>
      <div class="card-body">
        <div v-if="loading">Loading...</div>
        <div v-else-if="error" class="text-danger">
          Error: {{ error.message }}
        </div>
        <div v-else>
          <ProductList :products="formattedProducts" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useProductsStore } from "@/stores/products";
import { storeToRefs } from 'pinia';
import { computed } from 'vue';
import ProductList from '@/components/ProductList.vue';

const productsStore = useProductsStore();
const { products, loading, error } = storeToRefs(productsStore);

// Computed property for product count
const productCount = computed(() => products.value.length);

// Computed property for formatted product data
const formattedProducts = computed(() => {
  return products.value.map(product => ({
    ...product,
    formattedPrice: `$${parseInt(product.price).toFixed(2)}`,
  }));
});
</script>
