<template>
  <app-layout>
    <article class="flex flex-col justify-center items-center py-10 px-5">
      <div class="w-1/2 flex flex-col gap-5">
        <div class="flex flex-col" v-for="article in articles" :key="article.id">
          <inertia-link :href="route('articles.show', article.id)">
            <h1 class="text-xl font-bold">{{ article.title }}</h1>
            <h2 class="text-lg font-medium">{{ article.tagline }}</h2>
            <div>{{format(article.created_at)}}</div>
          </inertia-link>
        </div>
      </div>
    </article>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

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
        }
      }
    }
</script>