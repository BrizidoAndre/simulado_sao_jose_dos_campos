<script setup>
import Field from "@/components/Field.vue";
import {reactive} from "vue";
import {api} from "@/helpers/api.js";
import {useRouter} from "vue-router";
import {token} from "@/helpers/globals.js";

const user = reactive({
  username: '',
  password: '',
})

const router = useRouter();

async function submit() {
  const [res, data] = await api.post('login', {...user});
  if (data?.token) {
    token.value = data.token;
    router.push('/');
  }
}
</script>

<template>
  <h1>Login</h1>
  <form action="" @submit.prevent="submit">
    <field v-model="user.username">Username</field>
    <field type="password" v-model="user.password">Password</field>
    <button class="btn btn-primary">Login</button>
  </form>
</template>

<style scoped>

</style>