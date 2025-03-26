<template>
	<tr class="">
	  <td>
		<img
		  :src="product.image_url"
		  alt="Product"
		  class="m-3"
		  style="width: 50px"
		/>
	  </td>
	  <td>
		<strong>ID: {{ product.id }} - {{ product.name }}</strong>
		<p class="mb-0">Quantity: {{ cartItem.quantity }}</p>
		<p class="mb-0">Price: {{ `$${parseInt(product.price).toFixed(2)}` }}</p>
	  </td>
	  <td>
		{{ `$${(parseInt(product.price) * cartItem.quantity).toFixed(2)}` }}
	  </td>
	  <td>
		<button
			class="btn btn-warning ms-2"
			@click="handleRemoveToCart(product)"
			:disabled="removingToCart"
		  >
			<span v-if="removingToCart">Removing...</span>
			<span v-else>Remove</span>
		  </button>
	</td>
	</tr>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { useRemoveToCart } from '@/composables/useRemoveToCart';
  const props = defineProps({
	  cartItem: {
		  type: Object,
		  required: true,
	  }
  });
  
  const product = computed(() => props.cartItem.product);
  const { handleRemoveToCart, removingToCart, removeToCartError, removeToCartSuccess } = useRemoveToCart();
  </script>
  