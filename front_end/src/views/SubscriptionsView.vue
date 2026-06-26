<script setup>

import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {useModal} from "@/helpers/useModal.js";
import ModalSubscriptionCreate from "@/components/modals/ModalSubscriptionCreate.vue";
import ModalSubscriptionUpdate from "@/components/modals/ModalSubscriptionUpdate.vue";

const models = ref([]);
const modal = useModal();

function handleCreate() {
  modal.open(ModalSubscriptionCreate, {
    'onLoad': loadModels,
  })
}

async function handleDelete(id) {
  if (confirm('Are you sure? All related data will be lost.')) {
    const [res, data] = await api.delete('subscriptions/' + id);
    loadModels();
  }
}

function handleUpdate(model) {
  modal.open(ModalSubscriptionUpdate, {
    'onLoad': loadModels,
    ...model,
  })
}

async function loadModels() {
  const [res, data] = await api.get('subscriptions');
  if (res.ok) {
    models.value = data;
  }
}

onMounted(() => {
  loadModels()
})

</script>

<template>
  <div class="hstack justify-content-between">
    <h1>Subscriptions</h1>
    <button @click="handleCreate" class="btn btn-primary">Create new subscription</button>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Customer</th>
      <th>Plan</th>
      <th>Start Date</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="model in models" :key="model.id">
      <td>{{ model.id }}</td>
      <td>{{ model.customer.name }}</td>
      <td>{{ model.plan.name }}</td>
      <td>{{ model.start_date }}</td>
      <td class="hstack gap-1">
        <button class="btn btn-secondary" @click="handleUpdate(model)">Edit</button>
        <button class="btn btn-danger" @click="handleDelete(model.id)">Delete</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>