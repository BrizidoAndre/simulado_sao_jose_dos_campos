<script setup>

import {reactive} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";

const emits = defineEmits(['close', 'load'])
const props = defineProps(['id', 'created_at', 'updated_at', 'name', 'price', 'monthly_usage_limit'])

async function submit() {
  const [res, data] = await api.put('plans/' + props.id, {...model});
  if (res.ok) {
    emits('load');
    emits('close');
  }
}

const model = reactive({
  name: props?.name,
  price: props?.price,
  monthly_usage_limit: props?.monthly_usage_limit,
})
</script>

<template>
  <h2>Update</h2>
  <form action="" @submit.prevent="submit">
    <field v-model="model.name">Name</field>
    <field v-model="model.price" type="number">Price</field>
    <field v-model="model.monthly_usage_limit" type="number">Montly usage Limit</field>
    <button class="btn btn-primary">Edit</button>
  </form>
</template>

<style scoped>

</style>