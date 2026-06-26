<script setup>
import {onMounted, watch} from "vue";
import ModalTransactionUpdate from "@/components/modals/ModalTransactionUpdate.vue";
import {useModal} from "@/helpers/useModal.js";

const props = defineProps(['model'])
const emits = defineEmits(['load'])

function currencyFormat(number) {
  number = number.toString();
  if (number.length <= 2) {
    return 0;
  }
  const cents = number.slice(number.length - 2);
  const left = number.slice(0, number.length - 2);
  return left + ',' + cents;
}

const modal = useModal();

function handleUpdate(model) {
  modal.open(ModalTransactionUpdate, {
    'onLoad': emits('load'),
    ...model,
  })
}

const statusBg = {
  'not_apply': 'text-bg-secondary',
  'paid': 'text-bg-success',
  'pending': 'text-bg-primary',
}

onMounted(()=>{
  console.log(props.model.subscription);
})
</script>

<template>
  <tr>
    <td>{{ model.subscription.customer.name }}</td>
    <td>{{ model.transaction_date }}</td>
    <td>{{ model.subscription.plan.name }}</td>
    <td>{{ model.worker?.name ?? 'Not applied yet' }}</td>
    <td>US${{ currencyFormat(model.amount) }}</td>
    <td class="text-capitalize">
        <span class="badge" :class="statusBg[model.status]">
        {{ model.status }}
        </span>
    </td>
    <td>{{ model.usage_count }}/{{ model.subscription.plan.monthly_usage_limit }}</td>
    <td>
      <button class="btn btn-primary" @click="handleUpdate(model)">✍️</button>
    </td>
  </tr>
</template>

<style scoped>

</style>