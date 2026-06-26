<script setup>

import AppToast from "@/components/AppToast.vue";
</script>

<template>
  <main class="container py-5">
    <RouterView/>
  </main>
  <app-toast></app-toast>
</template>