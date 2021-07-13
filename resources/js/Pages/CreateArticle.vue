<template>
  <app-layout>
    <div class="w-full flex flex-col items-center py-10">
      <form class="flex xl:flex-row flex-col w-full gap-5" @submit.prevent="submit()">
        <div class="xl:w-3/4 flex flex-col gap-10">
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
                  image | bullist numlist outdent indent | \
                  removeformat | help'
              }"
            />
          </div>
        </div>
        <div class="xl:w-1/4 px-5 flex flex-col">
          <div>
            <h3>Category</h3>
            <MultiSelect 
              v-model="form.selectedCategories" 
              :options="categories" 
              optionLabel="cat" 
              placeholder="Select Categories" 
              display="chip"
              :filter="true"
              class="max-w-full w-full"
            />
            <div>
              <label for="addCat">New Category</label>
              <div class="flex gap-5">
                <input id="addCat" class="border border-gray-300 p-2" />
                <button 
                  class="border border-gray-400 text-gray-700 bg-gray-200 p-2 rounded" 
                  type="button" 
                  @click="addCat()"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
          <div>Save/Publish</div>
          <button class="border border-gray-400 text-gray-700 bg-gray-200 p-3 rounded" type="submit">Publish</button>
          <div v-show="$page.props.flash.message">
            {{ $page.props.flash.message }}
          </div>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Editor from '@tinymce/tinymce-vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import MultiSelect from 'primevue/multiselect';

    export default {
      components: {
          AppLayout,
          MultiSelect,
          'editor': Editor,
      },
      data() {
        return {
          categories: this.possibleCategories,
        }
      },
      props: {
        article: Object,
        currentCategories: {
          type: Array,
          default: [],
        },
        possibleCategories: {
          type: Array,
          default: [],
        }
      },
      setup (props) {
        if(props.article === undefined || props.article.length == 0) {
          const form = useForm({
            title: null,
            tagline: null,
            text: null,
            selectedCategories: [],
          })

          return { form }

        } else {
          const form = useForm({
            title: props.article.title,
            tagline: props.article.tagline,
            text: props.article.text,
            selectedCategories: props.currentCategories
          })

          return { form }
        }
      },
      methods: {
        submit() {
          if(this.article === undefined || this.article.length == 0) {
            this.form.post('/articles')
          } else {
            this.form.put('/articles/' + this.article.id)
          }
        },
        addCat() {
          let category = document.getElementById('addCat').value;
          const categoryObject = {cat: category, value: category};
          if (this.categories.filter(e => e.cat === category).length <= 0 && category != "") {
            this.categories.push(categoryObject);
            this.form.selectedCategories.push(categoryObject);
          }
        }
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