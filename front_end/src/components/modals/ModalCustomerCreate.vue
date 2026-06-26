<script setup>

import {reactive} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";

const emits = defineEmits(['close', 'load'])

async function submit() {
  const [res, data] = await api.post('customers', {...model});
  if (res.ok) {
    emits('load');
    emits('close');
  }
}

const model = reactive({
  name: '',
})
</script>

<template>
  <h2>Create</h2>
  <form action="" @submit.prevent="submit">
    <field v-model="model.name">Name</field>
    <button class="btn btn-primary">Save</button>
  </form>
</template>

<style scoped>

</style>