<template>
  <div class="product">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">My Cart 
          <button class="btn btn-danger float-end mx-2">Empty Cart</button>
          <button class="btn btn-primary float-end mx-2">Proceed to Checkout</button>
          
        </h4>
      </div>
      <div class="card-body">
        <div v-if="loading">Loading...</div>
        <div v-if="error">Error: {{ error.message }}</div>
        <div class="float-end m-2">Total of {{ productCount }} products</div>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="productCount">
            <tr v-for="product in formattedProducts" :key="product.id">
              <td>{{ product.id }}</td>
              <td>
                <img :src="product.imageUrl" alt="Product Image" style="width: 50px; height: 50px;">
              </td>
              <td>{{ product.title }}</td>
              <td>{{ product.formattedPrice }}</td>
              <td>
                <button class="btn btn-sm btn-primary">Add To Cart</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5" class="text-center">No products found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { usePostsStore } from "@/stores/posts";
  import { storeToRefs } from 'pinia';
  import { computed } from 'vue';

  const postsStore = usePostsStore();
  const { posts, loading, error } = storeToRefs(postsStore);

  // Computed property for product count
  const productCount = computed(() => posts.value.length);

  // Computed property for formatted product data
  const formattedProducts = computed(() => {
    return posts.value.map(post => ({
      ...post,
      imageUrl: 'https://picsum.photos/200?t=' + Math.random(), // Replace with actual image URL
      formattedPrice: `$${(Math.random() * 100).toFixed(2)}`, // Replace with actual price formatting logic
    }));
  });

  // Example of a re-usable function
  function handleEdit(productId) {
    console.log(`Edit product with ID: ${productId}`);
    // Add edit logic here
  }

  function handleDelete(productId) {
      console.log(`Delete product with ID: ${productId}`);
      // add delete logic here
  }
</script>