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
    },
    destroyed() {
      this.stopTimer()
    },
    props: {
      'parent': String,
      'name': String,
      'error': String,
    },
    methods: {
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
