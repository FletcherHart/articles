<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-3
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      uppercase
      tracking-widest
      focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300
      disabled:opacity-25
      transition
      shadow
    "
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
}
</script>
