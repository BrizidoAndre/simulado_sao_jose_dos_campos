<script setup>

import {alerts} from "@/helpers/addAlert.js";
</script>

<template>
  <div class="position-fixed end-0 bottom-0 m-5 z-2">
    <transition-group>
      <div class="alert" :class="'alert-' +alert.type" role="alert" v-for="alert in alerts" :key="alert.id">
        {{ alert.message }}
      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.v-enter-active,
.v-leave-active,
.v-move {
  transition: .4s;
}

.v-leave-active {
  position: absolute;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
  transform: translateX(150%);
}
</style>