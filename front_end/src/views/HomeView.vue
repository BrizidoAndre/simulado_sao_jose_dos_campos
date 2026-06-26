<script setup>
import Field from "@/components/Field.vue";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {api} from "@/helpers/api.js";
import FieldSelect from "@/components/FieldSelect.vue";
import {useModal} from "@/helpers/useModal.js";
import ModalTransactionUpdate from "@/components/modals/ModalTransactionUpdate.vue";
import TransactionRow from "@/components/TransactionRow.vue";
import {addAlert} from "@/helpers/addAlert.js";

const filters = reactive({
  'start_date': getInitMonth(),
  'end_date': getLastMonth(),
  'customer': "",
  'plan': "",
  'worker': "",
  'status': '',
})
const statuses = [
  'pending',
  'paid',
  'not_apply'
]
const statusBg = {
  'not_apply': 'text-bg-secondary',
  'paid': 'text-bg-success',
  'pending': 'text-bg-primary',
}

function getInitMonth() {
  const now = new Date();
  now.setDate(1);
  const res = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, "0")}-${now.getDate().toString().padStart(2, "0")}`;
  return res;
}

function getLastMonth() {
  const now = new Date();
  now.setMonth(now.getMonth() + 1);
  now.setDate(0);
  const res = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, "0")}-${now.getDate().toString().padStart(2, '0')}`;
  return res;
}

const customers = ref([]);
const plans = ref([]);
const workers = ref([]);

async function loadSelect() {
  const [clientRes, clientData] = await api.get('customers');
  const [plansRes, plansData] = await api.get('plans');
  const [workersRes, workersData] = await api.get('workers');
  customers.value = clientData;
  plans.value = plansData;
  workers.value = workersData;
}

function clearFilters() {
  filters.start_date = getInitMonth();
  filters.end_date = getLastMonth();
  filters.customer = "";
  filters.plan = "";
  filters.worker = "";
  filters.status = '';
}

const models = ref([]);
const total = computed(() => {
  let sum = 0;
  models.value.forEach(m => {
    if (m.status === 'paid') {
      sum += m.amount;
    }
  })
  return currencyFormat(sum);
})

function currencyFormat(number) {
  number = number.toString();
  if (number.length <= 2) {
    return 0;
  }
  const cents = number.slice(number.length - 2);
  const left = number.slice(0, number.length - 2);
  return left + ',' + cents;
}

async function loadModels() {
  const filtersQuery = new URLSearchParams();
  for (const filtersKey in filters) {
    if (filters[filtersKey] !== '') {
      filtersQuery.append(filtersKey, filters[filtersKey]);
    }
  }
  const url = 'transactions?' + filtersQuery.toString();
  const [res, data] = await api.get(url);
  models.value = data;
}

const modal = useModal();

function handleUpdate(model) {
  modal.open(ModalTransactionUpdate, {
    'onLoad': loadModels,
    ...model,
  })
}

async function markAsPaid(id) {
  if (confirm('Should mark this transaction as paid?')) {
    const [res, data] = await api.post(`transactions/${id}/mark-as-paid`, {});
    if (res === null) {
      addAlert('The transaction must be associated with a professional in order to be marked as paid.', 'danger');
    } else {
      loadModels();
    }
  }
}

onMounted(() => {
  loadSelect();
  getInitMonth();
  getLastMonth();
  loadModels();
})
watch(filters, value => {
  loadModels()
})
</script>

<template>
  <div class="hstack justify-content-between">
    <h1>Transactions Management</h1>
    <div>
      <p class="text-end mb-0">Period:</p>
      <div class="d-flex gap-2 align-items-center">
        <field v-model="filters.start_date" type="date"></field>
        <span class="mx-2">to</span>
        <field v-model="filters.end_date" type="date"></field>
      </div>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
    <tr>
      <th>Customer</th>
      <th>Transaction Date</th>
      <th>Plan</th>
      <th>Worker</th>
      <th>Amount</th>
      <th>Status</th>
      <th>Usage</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <field-select label="" v-model="filters.customer">
          <option value="">Select a client</option>
          <option :value="customer.id" v-for="customer in customers">{{ customer.name }}</option>
        </field-select>
      </td>
      <td></td>
      <td>
        <field-select label="" v-model="filters.plan">
          <option value="">Select a plan</option>
          <option :value="plan.id" v-for="plan in plans">{{ plan.name }}</option>
        </field-select>
      </td>
      <td>
        <field-select label="" v-model="filters.worker">
          <option value="">Select a professional</option>
          <option
              v-for="worker in workers"
              :value="worker.id"
          >{{ worker.name }}
          </option>
        </field-select>
      </td>
      <td></td>
      <td>
        <field-select label="" v-model="filters.status">
          <option value="">All</option>
          <option class="text-capitalize" v-for="status in statuses" :value="status">{{ status }}</option>
        </field-select>
      </td>
      <td></td>
      <td>
        <button class="btn btn-primary" @click="clearFilters">Clear</button>
      </td>
    </tr>
    <tr v-for="model in models" :key="model.id">
      <td>{{ model.subscription.customer.name }}</td>
      <td>{{ model.transaction_date }}</td>
      <td>{{ model.subscription.plan.name }}</td>
      <td>{{ model.worker?.name ?? 'Not applied yet' }}</td>
      <td>US${{ currencyFormat(model.amount) }}</td>
      <td class="text-capitalize">
        <span class="badge show-btn" :class="statusBg[model.status]">
        {{ model.status }}
        </span>
        <button
            v-if="model.status === 'pending'"
            class="btn btn-success d-none"
            @click="markAsPaid(model.id)"
        >Mark as Paid
        </button>
      </td>
      <td>{{ model.usage_count }}/{{ model.subscription.plan.monthly_usage_limit }}</td>
      <td>
        <button class="btn btn-primary" @click="handleUpdate(model)">✍️</button>
      </td>
    </tr>
    </tbody>
  </table>
  <div>
    <h2 class="text-end">Total Amount: US$ {{ total }}</h2>
  </div>
</template>
<style scoped>

.show-btn:hover ~ .btn.btn-success,
.btn.btn-success:hover {
  display: block !important;
}
</style>