<template>
    <div>
      <p>Logging out...</p>
    </div>
</template>
  
<script setup>
  import { useAuth } from '@/composables/useAuth'; 

  const { handleLogout } = useAuth(); 
  
  handleLogout('/login');
  
</script>