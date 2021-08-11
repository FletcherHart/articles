<template>
  <admin-layout>
    <div class="flex flex-col w-full px-2">
      <div
        v-if="$page.props.flash.error"
        class="w-full text-center text-lg text-red-700 py-10"
      >
        {{ $page.props.flash.error }}
      </div>
      <div class="flex flex-col-reverse gap-10 py-10 sm:px-5">
        <div class="xl:w-11/12 lg:w-10/12 self-center">
          <div class="flex justify-between mb-5">
            <ButtonGray @click="page(this.pages.first)">
              <box-icon name="first-page"></box-icon> First
            </ButtonGray>
            <ButtonGray @click="page(this.pages.previous)">
              <box-icon name="chevrons-left"></box-icon> Prev
            </ButtonGray>
            <ButtonGray @click="page(this.pages.next)">
              Next <box-icon name="chevrons-right"></box-icon>
            </ButtonGray>
            <ButtonGray @click="page(this.pages.last)">
              Last <box-icon name="last-page"></box-icon>
            </ButtonGray>
          </div>
          <div
            class="
              w-full
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <table
              class="w-full text-left divide-y divide-gray-200 table-fixed"
            >
              <thead class="bg-gray-200 text-gray-700">
                <tr>
                  <th class="w-3/5">Email Address</th>
                  <th class="w-1/5 px-6 py-3 hidden lg:block">Name</th>
                  <th class="w-1/5 px-6 py-3">
                    <span class="sr-only">Delete</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="address in addresses" :key="address.key">
                  <td class="">
                    {{ address.address }}
                    <div class="lg:hidden flex gap-1 text-sm">
                      <p class="text-gray-700 inline">Name</p>
                      {{ address.name }}
                    </div>
                  </td>
                  <td class="hidden lg:table-cell">{{ address.name }}</td>
                  <td class="float-right px-5">
                    <button
                      class="text-red-600 fill-current"
                      @click="destroy(address.address)"
                      aria-label="Delete address"
                    >
                      <box-icon name="trash"></box-icon>
                    </button>
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
              <h3 class="text-sm">
                Please do not add subscribers who have previously unsubscribed.
              </h3>
            </div>
            <subscribe-email></subscribe-email>
          </div>
        </div>
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout"
import { Inertia } from "@inertiajs/inertia"
import { useForm } from "@inertiajs/inertia-vue3"
import SubscribeEmail from "../Components/SubscribeEmail.vue"
import ButtonGray from "../Components/ButtonGray.vue"

export default {
  components: { AdminLayout, SubscribeEmail, ButtonGray },
  props: {
    addresses: Array,
    pages: Array,
  },
  setup() {
    const form = useForm({
      targetPage: null,
    })

    return { form }
  },
  methods: {
    page(target) {
      this.form.targetPage = target
      this.form.post(route("email-list"))
    },
    destroy(address) {
      Inertia.delete(route("email-list.destroy", address))
    },
  },
}
</script>

<style>
.error {
  color: red;
  font-weight: 700;
  font-size: larger;
}

th,
td {
  padding: 0.5rem;
}
</style>
