<script setup>
import {ref} from "vue";
import Field from "@/components/Field.vue";
import {addToast} from "@/helpers/addToast.js";

const title = ref('');
const todos = ref([]);

function submit() {
  if (title.value === '') {
    addToast('No value entered', 'danger');
    return null;
  }
  const id = Math.random();
  todos.value.push({
    id,
    title: title.value,
    done: false,
  })
  title.value = '';
}
</script>

<template>
  <h1>Home</h1>
  <form action="" @submit.prevent='submit'>
    <field autofocus v-model="title"></field>
    <button class="btn btn-primary">Add</button>
  </form>
  <ul class="list-group my-3">
    <li
        class="list-group-item"
        :class="todo.done && 'text-decoration-line-through'"
        v-for="(todo,i) in todos"
        @click="todo.done = !todo.done"
    >
      {{ todo.title }}
      <button class="btn btn-close" @click.stop="todos.splice(i,1)"></button>
    </li>
  </ul>
</template>
