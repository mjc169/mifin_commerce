<template>
    <form submit.prevent="login">
        <div data-mdb-input-init class="form-outline mb-4">
            <input
                type="email"
                id="form3Example3"
                class="form-control form-control-lg"
                placeholder="Enter a valid email address"
                v-model="email"
                autocomplete="email"
            />
        </div>

        <div data-mdb-input-init class="form-outline mb-3">
            <input
                type="password"
                id="form3Example4"
                class="form-control form-control-lg"
                placeholder="Enter password"
                v-model="password"
                autocomplete="current-password"
            />
        </div>

        <h6>For testing purpose: </h6>
        <div>
            <div>Email: <code class="p-2">mifin@example.com</code></div>
            <div>Password: <code class="p-2">password</code></div>
        </div>
        <div class="text-center text-lg-start mt-4 pt-2">
            <button
                type="button"
                data-mdb-button-init
                data-mdb-ripple-init
                class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;"
                @click="handleLogin"
            >
                Login
            </button>
        </div>

        <p v-if="error" class="text-danger">{{ error }}</p>
        <p v-if="loading">Loading...</p>
    </form>
</template>

<script setup>
    import { ref } from 'vue';
    import { useAuth } from '@/composables/useAuth';

    const { handleLogin: login, loading, error, clearAuthError } = useAuth();

    const email = ref('');
    const password = ref('');

    const handleLogin = async () => {
    try {
        clearAuthError();
        await login({ email: email.value, password: password.value });
        // Redirect or perform other actions after successful login
    } catch (err) {
        // Error is handled by the composable, but you can add more logic here if needed.
        console.warn("HANDLE LOGIN", err);
    }
    };
</script>