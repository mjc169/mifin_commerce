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
	  <td><button class="btn btn-warning ms-2">Remove</button></td>
	</tr>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  const props = defineProps({
	  cartItem: {
		  type: Object,
		  required: true,
	  }
  });
  
  const product = computed(() => props.cartItem.product);
  </script>
  