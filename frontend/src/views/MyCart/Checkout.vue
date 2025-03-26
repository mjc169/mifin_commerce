<template>
  <div class="container" v-if="!isLoading">
    <form class="row g-3" @submit.prevent="processCheckout">
      <div class="col-6">
        <label for="inputName" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="inputName"
          :disabled="true"
          :value="user.name"
        />
      </div>
      <div class="col-6">
        <label for="inputEmail" class="form-label">Email</label>
        <input
          type="text"
          class="form-control"
          id="inputEmail"
          :disabled="true"
          :value="user.email"
        />
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input
          type="text"
          class="form-control"
          id="inputAddress"
          placeholder="House Number/Unit# Building Name, Street Name"
          v-model="address"
        />
      </div>

      <div class="col-md-6">
        <label for="inputCity" class="form-label">City</label>
        <input type="text" class="form-control" id="inputCity" v-model="city"/>
      </div>
      <div class="col-md-4">
        <label for="inputState" class="form-label">State</label>
        <select id="inputState" class="form-select" v-model="state">
          <option value="">Select State</option>
          <option value="Victoria">Victoria</option>
          <option value="Queensland">Queensland</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="inputZip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="inputZip" v-model="zip" />
      </div>
      <div class="col-12">

        <button
          type="submit"
          class="btn btn-primary"
          @click="handleLogin"
          :disabled="checkingOut"
        >
          <span v-if="!checkingOut">Checkout</span>
			    <span v-else>Checking out...</span>
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useCheckoutCart } from "@/composables/useCheckoutCart"; // Import the composable

const authStore = useAuthStore();
const { handleCheckout, checkingOut, checkoutError, checkoutSuccess } = useCheckoutCart(); // Use the composable

const user = ref(null);
const isLoading = ref(true);

const address = ref("");
const city = ref("");
const state = ref("");
const zip = ref("");

const processCheckout = async () => {
  const formData = {
    address: address.value,
    city: city.value,
    state: state.value,
    zip: zip.value,
  };

  await handleCheckout(formData); // Pass formData to the composable
};

onMounted(async () => {
  try {
    isLoading.value = true;
    await authStore.fetchUser();
    user.value = authStore.user;
    isLoading.value = false;
  } catch (error) {
    console.error("Error fetching user on mount:", error);
  }
});
</script>