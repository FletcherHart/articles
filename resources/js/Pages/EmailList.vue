<template>
  <app-layout>
    <form class="flex xl:flex-row flex-col w-full gap-5" @submit.prevent="submit()">
      <label>
          <input
              type="text"
              placeholder="Topic"
              v-model="form.emailTopic"
          />
      </label>
      <label>
          <input
              type="email"
              placeholder="Sender Email"
              v-model="form.senderEmail"
          />
      </label>
      <label>
          <textarea
              placeholder="Enter email body"
              v-model="form.emailBody"
          ></textarea>
      </label>
      <button type="submit" class="btn btn-outline-success">
          Send Emails
      </button>
    </form>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  components: { AppLayout },
  setup () {
    const form = useForm({
      emailTopic: null,
      senderEmail: null,
      emailBody: null,
    })

    function submit() {
      this.form.post('/email-list')
    }

    return {form, submit}
  },
  methods: {
  }
}
</script>