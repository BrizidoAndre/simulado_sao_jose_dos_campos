<script setup>
import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {useModal} from "@/helpers/useModal.js";
import ModalPlanCreate from "@/components/modals/ModalPlanCreate.vue";
import ModalPlanUpdate from "@/components/modals/ModalPlanUpdate.vue";

const plans = ref([]);

const modal = useModal();

function handleCreate() {
  modal.open(ModalPlanCreate, {
    'onLoad': loadModels,
  });
}

async function handleDelete(id) {
  if (confirm('Are you sure? All related data will be lost')) {
    const [res, data] = await api.delete('plans/' + id);
    loadModels();
  }
}

function handleUpdate(model) {
  modal.open(ModalPlanUpdate, {
    'onLoad': loadModels,
    ...model
  });
}

async function loadModels() {
  const [res, data] = await api.get('plans');
  plans.value = data;
}

onMounted(() => {
  loadModels();
})
</script>

<template>
  <div class="hstack justify-content-between">
    <h1>Plans</h1>
    <button class="btn btn-primary" @click="handleCreate">Create new Plan</button>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Monthly limit</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="plan in plans" :key="plan.id">
      <td>{{ plan.id }}</td>
      <td>{{ plan.name }}</td>
      <td>{{ plan.price }}</td>
      <td>{{ plan.monthly_usage_limit }}</td>
      <td class="hstack gap-2">
        <button class="btn btn-secondary" @click="handleUpdate(plan)">Edit</button>
        <button class="btn btn-danger" @click="handleDelete(plan.id)">Delete</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>