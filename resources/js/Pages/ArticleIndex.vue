<template>
  <app-layout>
    <article class="flex flex-col justify-center items-center py-10 px-5">
      <div class="md:w-2/3 lg:w-1/2 px-3 flex flex-col gap-3" v-if="articles != null || articles.length != 0">
        <div class="flex flex-col pb-3 border-b border-gray-300" v-for="article in articles" :key="article.id">
          <div class="flex justify-between">
            <inertia-link :href="route('articles.show', article.id)">
              <h2 class="text-xl font-bold">{{ article.title }}</h2>
              <h3 class="text-lg font-medium">{{ article.tagline }}</h3>
              <div>{{format(article.created_at)}}</div>
            </inertia-link>
            <div class="self-end flex flex-col gap-2" v-show="route().current('articles.owned')">
              <a class="bg-yellow-500 text-white font-medium text-center p-3" :href="route('articles.edit', article.id)">Edit</a>
              <button class="bg-red-700 text-white font-medium p-3" @click="remove(article.id)">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div class="self-center" v-show="articles === null || articles.length == 0">
        <h1 class="text-4xl font-bold">No articles to display.</h1>
        <div class="flex flex-col" v-show="route().current('articles.owned')">
          <p>It looks like you haven't written any articles yet.</p>
          <inertia-link class="text-blue-600 hover:underline" :href="route('articles.create')">Click here to write one now.</inertia-link> 
        </div>
      </div>
    </article>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import { Inertia } from '@inertiajs/inertia'

    export default {
      components: {
        AppLayout
      },
      props: {
        articles: Array,
      },
      methods: {
        format(created_at) {
          let date = new Date(created_at)
          let options = { year: 'numeric', month: 'short', day: 'numeric' }

          return date.toLocaleDateString("en-US", options)
        },
        remove(article_id) {
          Inertia.delete(route('articles.destroy', article_id))
        }
      }
    }
</script>