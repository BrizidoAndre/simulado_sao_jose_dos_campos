<script setup>

import {token} from "@/helpers/globals.js";
import {api} from "@/helpers/api.js";
import {useRouter} from "vue-router";

const router = useRouter();

async function logout() {
  const [res, data] = await api.post('logout');
  token.value = null;
  router.push('/login');
}
</script>

<template>
  <header class="bg-body-tertiary">
    <nav class="container navbar navbar-expand">
      <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Gonzaga Barber</router-link>
        <div class="collapse navbar-collapse" id="nsavbarSupportedContent">
          <ul class="navbar-nav me-auto">
            <template v-if="token">
              <li class="nav-item">
                <router-link class="nav-link" to="/">Transactions</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/customers">Customers</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/workers">Workers</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/plans">Plans</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/subscriptions">Subscriptions</router-link>
              </li>
              <li class="nav-item">
                <button class="btn btn-danger" @click="logout">Logout</button>
              </li>
            </template>
            <template v-else>
              <li class="nav-item">
                <router-link class="nav-link" to="/login">Login</router-link>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>