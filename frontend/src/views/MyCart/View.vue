<template>
  <div class="product">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">
          My Cart
        </h4>
      </div>
      <div class="card-body">
        <div v-if="loading">Loading...</div>
        <div v-else-if="error" class="text-danger">Error: {{ error.message }}</div>
        <div v-else>
          <Cart :cart="cart" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { useCartStore } from "@/stores/cart";
  import { storeToRefs } from 'pinia';
  import Cart from '@/components/Cart.vue';

  const cartStore = useCartStore();
  const { cart, loading, error } = storeToRefs(cartStore);

</script>