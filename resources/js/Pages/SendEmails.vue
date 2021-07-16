<template>
  <app-layout>
    <form class="flex flex-col w-full gap-5 items-center py-10 px-5" @submit.prevent="submit()">
      <div class="md:w-1/2 w-full">
        <input
          type="text"
          class="w-full"
          placeholder="Topic"
          v-model="form.emailTopic"
        />
        <div class="error" v-show="form.errors.emailTopic">{{ form.errors.emailTopic }}</div>
      </div>
      <div class="md:w-1/2 w-full">
        <textarea
          class="w-full h-60"
          placeholder="Enter email body"
          v-model="form.emailBody"
        ></textarea>
        <div class="error" v-show="form.errors.emailBody">{{ form.errors.emailBody }}</div>
      </div>
      <button type="submit" class="btn btn-outline-success bg-gray-100 border border-gray-300 max-w-max">
          Send Emails
      </button>
      <div v-show="$page.props.flash.message">
        {{ $page.props.flash.message }}
      </div>
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

<style>
.error {
  color: red;
  font-weight: 700;
  font-size: larger;
}
</style>