<template>
  <app-layout>
    <div class="flex flex-col items-center justify-center w-full mt-20">
      <h1 class="text-4xl">{{ title }}</h1>
      <div>{{ body }}</div>
    </div>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
      components: {
        AppLayout
      },
      props: {
        title: String,
        body: String,
      },
    }
</script>