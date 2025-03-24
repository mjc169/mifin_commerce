<template>
  <header>
    <div class="wrapper">
      <TopNav />
    </div>
  </header>
  <RouterView />
</template>

<script setup>
  import TopNav from '@/components/TopNav.vue';
</script>