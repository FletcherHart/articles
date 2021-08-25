<template>
  <div>
    <button :class="classes" class="w-full text-left" v-if="is == 'button'">
      <slot></slot>
    </button>

    <inertia-link
      :href="href"
      class="
        flex
        items-center
        gap-5
        text-white
        pl-3
        pr-4
        py-2
        font-medium
        hover:bg-gray-700 hover:text-blue-400
      "
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
        ? "border-l-4 fill-current border-blue-400 focus:outline-none transition"
        : "border-l-4 fill-current border-transparent hover:border-blue-400 transition"
    },
  },
}
</script>
