<template>
  <div>Pick running ...</div>
</template>

<script>
export default {
  props: ['noDump'],
  data() {
    return {
      intervalId: null,
    }
  },
  mounted() {
    this.getDump()

    this.intervalId = setInterval(() => {
      this.getDump()
    }, 1000)
  },
  beforeDestroy() {
    clearInterval(this.intervalId)
  },
  methods: {
    getDump() {
      let iframes = [...document.querySelectorAll('iframe')]

      if (iframes.length > 1) {
        iframes[1].parentElement.remove()
      }

      if (this.noDump) {
        console.log('no dump')
      }

      this.$inertia.reload()
    },
  },
}
</script>

<style></style>
