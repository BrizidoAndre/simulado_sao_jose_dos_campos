<script setup>
import {useModal} from "@/helpers/useModal.js";

const {isOpen, options, component, open, close} = useModal();
</script>

<template>
  <transition>
    <div
        class="position-fixed z-1 start-0 top-0 vw-100 vh-100 d-flex justify-content-center align-items-center"
        v-if="isOpen"
        @click="close"
    >
      <div class="modal-wrapper bg-body-tertiary rounded-3 p-3" @click.stop>
        <component :is="component" v-bind="options" @close="close"></component>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.position-fixed {
  background: rgba(0, 0, 0, .7);
}

.v-enter-active,
.v-leave-active {
  transition: .3s;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

.modal-wrapper {
  width: clamp(300px, 80%, 600px);
}
</style>