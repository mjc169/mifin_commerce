<template>
	<div class="col">
		<div class="card h-100">
			<img :src="product.image_url" class="card-img-top" alt="Product Image">
			<div class="card-body">
				<h5 class="card-title">ID: {{ product.id }} - {{ product.name }}</h5>
				<p class="card-text text-warning">{{ product.formattedPrice }}</p>
			</div>
			<div class="card-footer">
				<a href="#" class="btn btn-primary">Add to Cart</a>
			</div>
		</div>
	</div>
</template>

<script setup>
defineProps({
	product: {
		type: Object,
		required: true,
	},
});
</script>