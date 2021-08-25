<template>
  <div>
    <form class="flex gap-5" @submit.prevent="addEmail()">
      <div class="flex flex-col">
        <label for="newEmail">Email:</label>
        <input
          type="email"
          placeholder="johndoe@email.com"
          v-model="form.email"
        />
      </div>
      <div class="self-end flex gap-5">
        <Button class="bg-purple-500 hover:bg-purple-600">Submit</Button>
      </div>
    </form>
    <div v-show="$page.props.flash.message">
      {{ $page.props.flash.message }}
    </div>
    <div v-show="$page.props.flash.subscribeError" class="text-lg text-red-700">
      {{ $page.props.flash.subscribeError }}
    </div>
    <div v-show="form.errors.email" class="text-lg text-red-700">
      {{ form.errors.email }}
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3"
import Button from "@/Jetstream/Button"

export default {
  components: {
    Button,
  },
  setup() {
    const form = useForm({
      email: null,
    })

    function addEmail() {
      this.form.post("/email.subscribe")
    }

    return { form, addEmail }
  },
  methods: {},
}
</script>
