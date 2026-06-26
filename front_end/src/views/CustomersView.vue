<script setup>

import {useModal} from "@/helpers/useModal.js";
import ModalCustomerCreate from "@/components/modals/ModalCustomerCreate.vue";
import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import ModalCustomerUpdate from "@/components/modals/ModalCustomerUpdate.vue";

const modal = useModal();

const customers = ref([]);

function handleCreate() {
  modal.open(ModalCustomerCreate, {
    'onLoad': loadCustomers,
  });
}

function handleUpdate(model) {
  modal.open(ModalCustomerUpdate, {
    'onLoad': loadCustomers,
    ...model,
  });
}

async function handleDelete(id) {
  if (confirm('Are you sure? All related data will be lost.')) {
    const [res, data] = await api.delete('customers/' + id);
    await loadCustomers();
  }
}

async function loadCustomers() {
  const [res, data] = await api.get('customers');
  customers.value = data;
}

onMounted(() => {
  loadCustomers()
})
</script>

<template>
  <div class="hstack justify-content-between">
    <h1>Customers</h1>
    <button class="btn btn-primary" @click="handleCreate">Create new Customer</button>
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
    <tr v-for="customer in customers" :key="customer.id">
      <td>{{ customer.id }}</td>
      <td>{{ customer.name }}</td>
      <td class="hstack gap-1">
        <button class="btn btn-secondary" @click="handleUpdate(customer)">Edit</button>
        <button class="btn btn-danger" @click="handleDelete(customer.id)">Delete</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>