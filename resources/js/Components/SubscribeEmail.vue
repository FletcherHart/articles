<template>
    <form class="flex xl:flex-row flex-col w-full gap-5" @submit.prevent="submit()">
      <label for="email">Email:</label>
      <input id="email" v-model="form.email" />
      <button>Submit</button>
    </form>

</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  setup () {
    const form = useForm({
      email: null
    })

    function submit() {
      this.form.post('/subscribe-email')
    }

    return {form, submit}
  },
  methods: {
  }
}
</script>