<template>
  <div class="flex flex-col">
    <div class="flex">
      <div class="h-screen sticky bg-gray-800 w-72">
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
      <div>
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

export default {
  components: {
    AdminLink,
  },
}
</script>
