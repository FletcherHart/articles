<template>
  <div>
    <button :class="classes" class="w-full text-left" v-if="is == 'button'">
      <slot></slot>
    </button>

    <inertia-link
      :href="href"
      class="flex items-center gap-5 text-white pl-3 pr-4 py-2 font-medium"
      :class="classes"
      v-else
    >
      <slot></slot>
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: ["active", "href", "is"],

  computed: {
    classes() {
      return this.active
        ? "bg-indigo-500 hover:bg-indigo-700 border-l-4 border-transparent hover:border-white focus:outline-none transition"
        : "hover:bg-gray-900 hover:text-blue-400 border-l-4 fill-current border-transparent hover:border-blue-400 transition"
    },
  },
}
</script>
