<template>
  <div>
    <div class="text-center">
      <div class="title mb-4">
        {{ title }}
      </div>

      <div class="text-muted">
        Laravel-Vue-Spa application
      </div>

      <div class="links">
        <a href="https://github.com/sidertopalov/Todo-Application">https://github.com/sidertopalov/Todo-Application</a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
</style>
