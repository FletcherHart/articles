<template>
  <app-layout>
    <article class="lg:w-2/3 flex flex-col justify-start items-start py-10">
      <div class="flex flex-col gap-5">
        <div class="flex flex-col">
          <h1 class="text-4xl font-bold">{{ article.title }}</h1>
          <h2 class="text-2xl font-medium">{{ article.tagline }}</h2>
          <div class="text-xl">{{format(article.created_at)}}</div>
        </div>
        <div class="leading-relaxed text-lg flex flex-col gap-3" v-html="article.text"></div>
      </div>
    </article>
    <side-layout></side-layout>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import SideLayout from "@/Layouts/SideLayout"

export default {
  components: {
    AppLayout,
    SideLayout,
  },
  props: {
    article: Object,
    author: String,

  },
  methods: {
    format(created_at) {
      let date = new Date(created_at)
      let options = { year: "numeric", month: "short", day: "numeric", }

      return date.toLocaleDateString("en-US", options)
    },
  },
}
</script>