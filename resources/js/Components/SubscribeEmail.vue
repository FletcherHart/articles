<template>
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
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  setup () {
    const form = useForm({
      email: null
    })

    function addEmail() {
      this.form.post('/subscribe-email')
    }

    return {form, addEmail}
  },
  methods: {
  }
}
</script>