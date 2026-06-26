<script setup>

import {toasts} from "@/helpers/addToast.js";
</script>

<template>
  <div class="position-fixed end-0 bottom-0 m-5">
    <transition-group>
      <div class="alert" :class="'alert-' + alert.type" v-for="alert in toasts" :key="alert.id">
        {{ alert.message }}
      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.v-enter-active,
.v-move,
.v-leave-active {
  transition: .4s;
}

.v-leave-active {
  position: absolute;
}

.v-enter-from,
.v-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>