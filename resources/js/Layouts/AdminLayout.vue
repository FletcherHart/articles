<template>
  <div class="flex flex-col">
    <div class="block sm:hidden w-full">
      <Button class="bg-indigo-300 w-1/2 rounded-none" @click="open('links')">
        Admin
      </Button>
      <Button class="bg-indigo-300 w-1/2 rounded-none" @click="open('page')">
        Page
      </Button>
    </div>
    <div class="flex">
      <div
        class="h-screen sticky bg-gray-800 w-full lg:w-72 md:w-56 sm:w-44 tab"
        id="links"
      >
        <ApplicationLogo></ApplicationLogo>
        <admin-link :href="route('admin')" :active="route().current('admin')">
          <box-icon name="home-heart" color="white"></box-icon> Home
        </admin-link>
        <admin-link
          :href="route('articles.create')"
          :active="route().current('articles.create')"
        >
          <box-icon name="file"></box-icon> Articles
        </admin-link>
        <admin-link
          :href="route('email-list')"
          :active="route().current('email-list')"
        >
          <box-icon name="envelope"></box-icon> Email List
        </admin-link>
      </div>
      <div class="tab hidden sm:flex" id="page">
        <!-- Page Heading -->
        <header
          v-if="$slots.header"
          class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8"
        >
          <slot name="header"></slot>
        </header>

        <!-- Page Content -->
        <main
          class="
            max-w-7xl
            mx-auto
            px-4
            sm:px-6
            lg:px-8
            flex
            lg:flex-row
            flex-col
          "
        >
          <slot></slot>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import AdminLink from "@/Components/AdminLink"
import Button from "@/Jetstream/Button"

export default {
  components: {
    AdminLink,
    Button,
  },
  methods: {
    open(tab) {
      let x = document.getElementsByClassName("tab")
      for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none"
      }

      document.getElementById(tab).style.display = "block"
    },
  },
}
</script>
