<template>
  <app-layout>
    <div class="flex flex-col items-center py-10">
      <form class="flex lg:flex-row flex-col w-full md:px-10 px-2 gap-5" @submit.prevent="form.post('/articles')">
        <div class="lg:w-2/3 flex flex-col gap-10">
          <div class="flex flex-col w-full">
            <label for="title">Title</label>
            <div class="error" v-show="form.errors.title">{{ form.errors.title }}</div>
            <input class="p-3 border border-gray-300 shadow" id="title" v-model="form.title"/>
          </div>
          <div class="flex flex-col w-full">
            <label for="tagline">Tagline</label>
            <div class="error" v-show="form.errors.tagline">{{ form.errors.tagline }}</div>
            <input class="p-3 border border-gray-300 shadow w-full" id="tagline" v-model="form.tagline"/>
          </div>
          <div class="w-full">
            <label for="text">Body</label>
            <div class="error" v-show="form.errors.text">{{ form.errors.text }}</div>
            <editor
              id="text"
              v-model="form.text"
              api-key="ptd43efbud1gfikm8ov7vw818u0tw2l3hxsbqm6h43gp3nyk"
              :init="{
                height: 500,
                width: '100%',
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
          </div>
        </div>
        <div class="lg:w-1/3 px-5 flex flex-col">
          <div>Save/Publish </div>
          <button class="border border-gray-400 text-gray-700 bg-gray-200 p-3 rounded" type="submit" >Publish</button>
        </div>
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

<style>
.error {
  color: red;
  font-weight: 700;
  font-size: larger;
}
</style>