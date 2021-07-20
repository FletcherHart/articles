<template>
  <app-layout>
    <div class="flex flex-col w-full">
      <div v-if="$page.props.flash.error" class="w-full text-center text-lg text-red-700 py-10">
        {{ $page.props.flash.error }}
      </div>
      <div class="flex md:flex-row flex-col-reverse gap-10 py-10 sm:px-5 w-full">
        <div class="w-full">
          <div class="flex justify-between mb-5">
            <ButtonGray @click="page(this.pages.first)">
              <box-icon name='first-page'></box-icon> First
            </ButtonGray>
            <ButtonGray @click="page(this.pages.previous)">
              <box-icon name='chevrons-left'></box-icon> Prev
            </ButtonGray>
            <ButtonGray @click="page(this.pages.next)">
              Next <box-icon name='chevrons-right'></box-icon>
            </ButtonGray>
            <ButtonGray @click="page(this.pages.last)">
              Last <box-icon name='last-page'></box-icon>
            </ButtonGray>
          </div>
          <div class="w-full shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full text-left divide-y divide-gray-200">
              <thead class="bg-gray-200 text-gray-700">
                <tr>
                  <th class="px-6 py-3">Subscribed</th>
                  <th class="px-6 py-3">Name</th>
                  <th class="w-2/4">Email Address</th>
                  <th class="px-6 py-3">
                    <span class="sr-only">Delete</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="address in addresses" :key="address.key">
                  <td class="px-6 py-3">{{ address.subscribed }}</td>
                  <td>{{ address.name }}</td>
                  <td>{{ address.address }}</td>
                  <td>
                    <button class="p-3 bg-red-700 text-white" @click="destroy(address.address)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="flex justify-end">
          <div class="flex flex-col gap-3">
            <div>
              <h2 class="text-lg">Add an email to the subscriber list.</h2>
              <h3 class="text-sm">Please do not add subscribers who have previously unsubscribed.</h3>
            </div>
            <subscribe-email></subscribe-email>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import SubscribeEmail from '../Components/SubscribeEmail.vue'
import ButtonGray from '../Components/ButtonGray.vue'

export default {
  components: { AppLayout, SubscribeEmail, ButtonGray},
  props: {
    addresses: Array,
    pages: Array
  },
  setup () {
    const form = useForm({
      targetPage: null,
    })

    return {form}
  },
  methods: {
    page(target) {
      this.form.targetPage = target
      this.form.post(route('email-list'))
    },
    destroy(address) {
      Inertia.delete(route('email-list.destroy', address))
    }
  },
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