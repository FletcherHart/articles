<template>
  <app-layout>
    <h1>{{ article.title }}</h1>
    <h2>{{ article.tagline }}</h2>
    <div v-html="article.text"></div>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
      components: {
        AppLayout
      },
      props: {
        article: Object,
        author: String,

      },
    }
</script>