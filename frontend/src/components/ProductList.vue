<template>
    <div>
      <template v-if="products.length > 0">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4">
          <ProductCard v-for="product in products" :key="product.id" :product="product" />
        </div>
      </template>
      <template v-else>
        <h5>No products found.</h5>
      </template>
    </div>
  </template>
  
<script setup>
  import ProductCard from './ProductCard.vue';
  
  defineProps({
    products: {
      type: Array,
      required: true
    },
  });
</script>