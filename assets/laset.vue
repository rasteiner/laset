<template>
  <kirby-section>
    <kirby-box v-if="error">
      {{ error }}
    </kirby-box>
    <kirby-box v-if="date">
      Last saved <span class="time">{{ ago }}</span> seconds ago
    </kirby-box>
  </kirby-section>
</template>

<script>
  export default {
    data() {
      return {
        date: null,
        ago: null
      }
    },
    created() {
      this.fetch()

      this.$events.$on("form.save", this.fetchLater);
      this.$events.$on("key.save", this.fetchLater);

      // TODO: find a way to react to the sibling fields section form submit event. 
      // even better, find a way to react to an inexistent "form.save.success" event...
    },
    destroyed() {
      this.stopTimer()
      
      this.$events.$off("form.save", this.fetchLater);
      this.$events.$off("key.save", this.fetchLater);
    },
    props: {
      'parent': String,
      'name': String,
      'error': String,
    },
    methods: {
      fetchLater() {
        window.setTimeout(this.fetch, 1000)
      },

      async fetch() {
        const response = await this.$api.section(this.parent, this.name);

        if(response.error) {
          this.error = response.error;
        } else {
          this.date = response.date;
          this.ago = response.ago;
          this.startTimer()
        }

      },
      stopTimer() {
        clearInterval(this.interval)
        this.interval = null
      },
      startTimer() {
        this.stopTimer()
        this.interval = setInterval(() => this.ago += 1, 1000)
      },
    }
  }
</script>

<style scoped>
  .time {
    color: red;
  }
</style>
