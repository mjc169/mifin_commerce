<template>
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <LoginImage />
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <LoginForm />
          </div>
        </div>
      </div>
      <Footer />
    </section>
  </template>
  
<script setup>
import LoginImage from '@/components/LoginImage.vue';
import LoginForm from '@/components/LoginForm.vue';
import Footer from '@/components/Footer.vue';
</script>