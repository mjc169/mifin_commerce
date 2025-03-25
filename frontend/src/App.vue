<template>
  <header>
    <div class="wrapper">
      <TopNav />
    </div>
  </header>

  <div class="my-5 container-fluid">
    <RouterView />
  </div>
</template>

<script setup>
  import TopNav from '@/components/TopNav.vue';
</script>