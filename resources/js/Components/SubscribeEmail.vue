<template>
  <div>
    <form class="flex gap-5" @submit.prevent="addEmail()">
      <div class="flex flex-col">
        <label for="newEmail">Email:</label>
        <input type="text" placeholder="johndoe@email.com" v-model="form.email" />
      </div>
      <div class="self-end">
        <button class="p-3 bg-green-600 text-white rounded">Submit</button>
      </div>
    </form>
    <div v-show="$page.props.flash.message">
      {{ $page.props.flash.message }}
    </div>
    <div v-show="$page.props.flash.subscribeError" class="text-lg text-red-700">
      {{ $page.props.flash.subscribeError }}
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3"

export default {
  setup () {
    const form = useForm({
      email: null,
    })

    function addEmail() {
      this.form.post("/subscribe-email")
    }

    return {form, addEmail,}
  },
  methods: {
  },
}
</script>