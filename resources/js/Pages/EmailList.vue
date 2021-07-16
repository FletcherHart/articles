<template>
  <app-layout>
    <div class="flex flex-col py-10 sm:px-5 w-full">
      <div class="w-full shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="w-full text-left divide-y divide-gray-200">
          <thead class="bg-gray-200 text-gray-700">
            <tr>
              <th class="px-6 py-3">ID</th>
              <th class="w-3/4">Email Address</th>
              <th class="px-6 py-3">
                <span class="sr-only">Delete</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="address in addresses" :key="address.id">
              <td>{{ address.id }}</td>
              <td>{{ address.email }}</td>
              <td>
                <button class="p-3 bg-red-700 text-white" @click="destroy(address.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { Inertia } from '@inertiajs/inertia'

export default {
  components: { AppLayout },
  props: {
    addresses: Array
  },
  methods: {
    destroy(id) {
      Inertia.delete(route('email-list', id))
    }
  }
}
</script>

<style>
.error {
  color: red;
  font-weight: 700;
  font-size: larger;
}

th, td {
  padding: 0.5rem;
}
</style>