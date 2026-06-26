<script setup>
import {useModal} from "@/helpers/useModal.js";
import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import ModalCustomerUpdate from "@/components/modals/ModalCustomerUpdate.vue";
import ModalWorkerCreate from "@/components/modals/ModalWorkerCreate.vue";
import ModalWorkerUpdate from "@/components/modals/ModalWorkerUpdate.vue";

const modal = useModal();

const workers = ref([]);

function handleCreate() {
  modal.open(ModalWorkerCreate, {
    'onLoad': loadWorkers,
  });
}

function handleUpdate(model) {
  modal.open(ModalWorkerUpdate, {
    'onLoad': loadWorkers,
    ...model,
  });
}

async function handleDelete(id) {
  if (confirm('Are you sure? All related data will be lost.')) {
    const [res, data] = await api.delete('workers/' + id);
    await loadWorkers();
  }
}

async function loadWorkers() {
  const [res, data] = await api.get('workers');
  workers.value = data;
}

onMounted(() => {
  loadWorkers()
})
</script>

<template>
  <div class="hstack justify-content-between">
    <h1>Workers</h1>
    <button class="btn btn-primary" @click="handleCreate">Create new Worker</button>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="worker in workers" :key="worker.id">
      <td>{{ worker.id }}</td>
      <td>{{ worker.name }}</td>
      <td class="hstack gap-1">
        <button class="btn btn-secondary" @click="handleUpdate(worker)">Edit</button>
        <button class="btn btn-danger" @click="handleDelete(worker.id)">Delete</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>