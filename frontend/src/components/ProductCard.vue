<template>
	<div class="col">
		<div class="card h-100">
			<img :src="product.image_url" class="card-img-top" alt="Product Image">
			<div class="card-body">
				<h5 class="card-title">ID: {{ product.id }} - {{ product.name }}</h5>
				<p class="card-text text-warning">{{ product.formattedPrice }}</p>
			</div>
			<div class="card-footer">
				<button 
					class="btn" 
					:class="{
						'btn-success': addToCartSuccess,
						'btn-primary': !addToCartSuccess
					}"

					@click="handleAddToCart(product)" 
					:disabled="addingToCart"
				>
					<span v-if="addingToCart">Adding...</span>
    				<span v-else-if="addToCartSuccess">Added to Cart</span>
					<span v-else>Add to Cart</span>
				</button>
				<p v-if="addToCartError" class="error-message">{{ addToCartError }}</p>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { defineProps } from 'vue';
	import { useAddToCart } from '@/composables/useAddToCart';

	const props = defineProps({
		product: {
			type: Object,
			required: true,
		},
	});

	const { handleAddToCart, addingToCart, addToCartError, addToCartSuccess } = useAddToCart();
</script>