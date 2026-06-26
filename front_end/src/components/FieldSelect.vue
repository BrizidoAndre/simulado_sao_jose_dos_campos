<script setup>

import {useId} from "vue";

const id = useId();
const model = defineModel();
defineOptions({
  inheritAttrs: false,
})
const props = defineProps(['label'])
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label">
      {{ label }}
    </label>
    <select :id="id" class="form-select" v-bind="$attrs" v-model="model">
      <slot></slot>
    </select>
  </div>
</template>