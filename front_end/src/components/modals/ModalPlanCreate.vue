<script setup>

import {reactive} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";

const emits = defineEmits(['close', 'load'])

async function submit() {
  const [res, data] = await api.post('plans', {...model});
  if (res.ok) {
    emits('load');
    emits('close');
  }
}

const model = reactive({
  name: '',
  price: 0,
  monthly_usage_limit: 0,
})
</script>

<template>
  <h2>Create</h2>
  <form action="" @submit.prevent="submit">
    <field v-model="model.name">Name</field>
    <field v-model="model.price" type="number">Price</field>
    <field v-model="model.monthly_usage_limit" type="number">Montly usage Limit</field>
    <button class="btn btn-primary">Save</button>
  </form>
</template>

<style scoped>

</style>