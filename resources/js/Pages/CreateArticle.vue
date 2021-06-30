<template>
  <app-layout>
    <div class="flex flex-col items-center my-10">
      <form @submit.prevent="form.post('/articles')">
        <label for="title">Title</label>
        <input id="title" v-model="form.title"/>
        <div v-if="form.errors.title">{{ form.errors.title }}</div>
        <label for="tagline">Tagline</label>
        <input id="tagline" v-model="form.tagline"/>
        <div v-if="form.errors.tagline">{{ form.errors.tagline }}</div>
        <editor
          id="text"
          v-model="form.text"
          api-key="ptd43efbud1gfikm8ov7vw818u0tw2l3hxsbqm6h43gp3nyk"
          :init="{
            height: 500,
            menubar: false,
            plugins: [
              'advlist autolink lists link image charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table paste code help wordcount'
            ],
            toolbar:
              'undo redo | formatselect | bold italic backcolor | \
              alignleft aligncenter alignright alignjustify | \
              bullist numlist outdent indent | removeformat | help'
          }"
        />
        <div v-if="form.errors.text">{{ form.errors.text }}</div>
        <button class="bg-blue-600 text-white p-3" type="submit" >Submit</button>
      </form>
    </div>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Editor from '@tinymce/tinymce-vue'
    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
      components: {
          AppLayout,
          'editor': Editor,
      },
      setup () {
        const form = useForm({
          title: null,
          tagline: null,
          text: false,
        })

        return { form }
      },
    }
</script>