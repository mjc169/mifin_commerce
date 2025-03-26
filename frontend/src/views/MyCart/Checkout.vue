<template>
  <div class="container">
    <form class="row g-3" @submit.prevent="processCheckout">
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input
          type="text"
          class="form-control"
          id="inputAddress"
          placeholder="1234 Main St"
        />
      </div>

      <div class="col-md-6">
        <label for="inputCity" class="form-label">City</label>
        <input type="text" class="form-control" id="inputCity" />
      </div>
      <div class="col-md-4">
        <label for="inputState" class="form-label">State</label>
        <select id="inputState" class="form-select">
          <option value="">Select State</option>
          <option value="Victoria">Victoria</option>
          <option value="Queensland">Queensland</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="inputZip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="inputZip" />
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">
          Checkout
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
const processCheckout = () => {
  alert("Now checking...");
};
</script>
