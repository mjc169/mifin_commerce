<template>
  <div class="product">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">
          Products
          <small class="text-muted">(Total of {{ productCount }} products)</small>
        </h4>
      </div>
      <div class="card-body">
        <div v-if="loading">Loading...</div>
        <div v-if="error">Error: {{ error.message }}</div>

        <div>
          <ProductList :products="formattedProducts" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePostsStore } from "@/stores/posts";
import { storeToRefs } from 'pinia';
import { computed } from 'vue';
import ProductList from '@/components/ProductList.vue';

const postsStore = usePostsStore();
const { posts, loading, error } = storeToRefs(postsStore);

// Computed property for product count
const productCount = computed(() => posts.value.length);

// Computed property for formatted product data
const formattedProducts = computed(() => {
  return posts.value.map(post => ({
    ...post,
    formattedPrice: `$${parseInt(post.price).toFixed(2)}`,
  }));
});
</script>