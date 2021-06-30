<template>
  <app-layout>
    <div class="flex flex-col items-center justify-center h-screen">
      <h1 class="text-4xl">{{ title }}</h1>
      <div>{{ description }}</div>
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
        error: Number,
      },
      computed: {
        title() {
          return {
            503: '503: Service Unavailable',
            500: '500: Server Error',
            404: '404: Page Not Found',
            403: '403: Forbidden',
          }[this.error]
        },
        description() {
          return {
            503: 'Sorry, we are doing some maintenance. Please check back soon.',
            500: 'Whoops, something went wrong on our servers.',
            404: 'Sorry, the page you are looking for could not be found.',
            403: 'Sorry, you are forbidden from accessing this page.',
          }[this.error]
        },
      }
    }
</script>