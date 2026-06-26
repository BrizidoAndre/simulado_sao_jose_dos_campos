<script setup>

import {onMounted, reactive} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";

const emits = defineEmits(['close', 'load'])
const props = defineProps(['id', 'name', 'created_at', 'updated_at'])

async function submit() {
  const [res, data] = await api.put(`workers/${props.id}`, {...model});
  if (res.ok) {
    emits('load');
    emits('close');
  }
}

const model = reactive({
  name: props?.name,
})
onMounted(() => {
})
</script>

<template>
  <h2>Update</h2>
  <form action="" @submit.prevent="submit">
    <field v-model="model.name">Name</field>
    <button class="btn btn-primary">Edit</button>
  </form>
</template>

<style scoped>

</style>