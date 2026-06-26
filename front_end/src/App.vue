<script setup>
import AppAlerts from "@/components/AppAlerts.vue";
import AppHeader from "@/AppHeader.vue";
import AppModal from "@/components/AppModal.vue";
</script>

<template>
  <AppHeader/>
  <main class="container py-5">
    <RouterView/>
  </main>
  <app-modal></app-modal>
  <app-alerts></app-alerts>
</template>