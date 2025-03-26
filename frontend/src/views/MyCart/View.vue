<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">My Cart</h4>

        <div class="mt-3 mb-5 text-end">
              My Balance: ${{ balance }}
        </div>
      </div>
      <div class="card-body">
        <div v-if="loading">Loading...</div>
        <div v-else-if="error" class="text-danger">
          Error: {{ error.message }}
        </div>
        <div v-else>
          <Cart :cart="cart" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Cart from '@/components/Cart.vue';
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useCartStore } from "@/stores/cart";
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart, loading, error } = storeToRefs(cartStore);

const authStore = useAuthStore(); // Get the auth store instance
const balance = ref(0.00); // Use a ref for reactivity

onMounted(async () => {
  try {
    await authStore.fetchUser();
    balance.value = parseFloat(authStore.user.balance).toFixed(2);
  } catch (error) {
    console.error('Error fetching user on mount:', error);
  }
});

</script>
