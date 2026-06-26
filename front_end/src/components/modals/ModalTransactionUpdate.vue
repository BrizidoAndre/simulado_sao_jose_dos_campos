<script setup>

import {onMounted, reactive, ref} from "vue";
import Field from "@/components/Field.vue";
import FieldSelect from "@/components/FieldSelect.vue";
import {api} from "@/helpers/api.js";

const props = defineProps(['id', 'subscription_id', 'amount', 'transaction_date', 'status', 'worker_id', 'usage_count', 'description', 'created_at', 'updated_at', 'worker', 'subscription'])
const emits = defineEmits(['close', 'load'])
const model = reactive({
      worker_id: props?.worker_id ?? '',
      transaction_date: props?.transaction_date,
      amount: props?.amount,
      description: props?.description,
      usage_count: props?.usage_count,
    }
)
const workers = ref([]);

async function submit() {
  const [res, data] = await api.put('transactions/' + props.id, {...model});
  if (res.ok) {
    emits('load')
    emits('close');
  }
}

async function loadSelects() {
  const [res, data] = await api.get('workers');
  workers.value = data;
}

onMounted(() => {
  loadSelects();
})
</script>

<template>
  <h2>Transaction Update</h2>
  <form action="" @submit.prevent="submit">
    <field v-model="model.amount" type="number">Amount</field>
    <field v-model="model.usage_count" type="number">Usage Count</field>
    <field-select label="Worker" v-model="model.worker_id">
      <option value="">Select a worker</option>
      <option v-for="worker in workers" :value="worker.id">{{ worker.name }}</option>
    </field-select>
    <field v-model="model.transaction_date" type="date">Transaction Date</field>
    <field v-model="model.description">Description</field>
    <button class="btn btn-primary">Edit</button>
  </form>
</template>