<template>
  <template v-if="cart && cart.cartItems && cart.cartItems.length > 0">
    <div class="mt-3 text-end">
      <strong>Total: {{ cartTotal }}</strong>
    </div>
    <div class="mt-3 mb-5 text-end">
      <button class="btn btn-danger ms-2">Empty Cart</button>
      <button class="btn btn-primary ms-2">Proceed to Checkout</button>
    </div>

    <div
      class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-3 g-4"
    >
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <CartItem
            v-for="cartItem in cart.cartItems"
            :key="cartItem.id"
            :cartItem="cartItem"
          />
        </tbody>
      </table>
    </div>
  </template>
  <template v-else>
    <h5>No product added in cart.</h5>
  </template>
</template>

<script setup>
import CartItem from './CartItem.vue';
import { computed } from 'vue';

const props = defineProps({
  cart: {
    type: Object,
    required: true
  },
});

const cartTotal = computed(() => {
  if (props.cart && props.cart.cartItems) {
    const grandTotal = props.cart.cartItems.reduce((total, item) => parseInt(total) + parseInt(item.product.price), 0);
    return `$${parseInt(grandTotal).toFixed(2)}`;
  }

  return 0; // Return 0 if cart or cartItems is undefined
});
</script>
