<script setup>

import {onMounted, reactive, ref} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";
import FieldSelect from "@/components/FieldSelect.vue";

const emits = defineEmits(['close', 'load'])
const props = defineProps(['created_at', 'updated_at', 'start_date', 'plan_id', 'plan', 'customer_id', 'customer', 'id'])

const model = reactive({
  customer_id: props?.customer_id,
  plan_id: props?.plan_id,
  start_date: props?.start_date,
})
const customers = ref([]);
const plans = ref([]);

async function submit() {
  const [res, data] = await api.put('subscriptions/' + props.id, {...model});
  if (res.ok) {
    emits('load');
    emits('close');
  }
}

async function loadSelects() {
  const [customerRes, customerData] = await api.get('customers');
  const [plansRes, plansData] = await api.get('plans');
  customers.value = customerData;
  plans.value = plansData;
}

onMounted(() => {
  loadSelects();
})
</script>

<template>
  <h2>Update</h2>
  <form action="" @submit.prevent="submit">
    <field-select label="Customer" v-model="model.customer_id">
      <option value="" disabled hidden selected>Select a customer</option>
      <option v-for="customer in customers" :value="customer.id">{{ customer.name }}</option>
    </field-select>
    <field-select label="Plan" v-model="model.plan_id">
      <option value="" disabled hidden selected>Select a plan</option>
      <option v-for="plan in plans" :value="plan.id">{{ plan.name }}</option>
    </field-select>
    <field v-model="model.start_date" type="date">Start date</field>
    <button class="btn btn-primary">Edit</button>
  </form>
</template>

<style scoped>

</style>