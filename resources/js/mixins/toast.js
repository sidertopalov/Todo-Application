import Vue from 'vue'
Vue.mixin({
  methods: {
    createSuccessToast: function (message, title) {
      // Bootstrap-Vue Toast Component
      this.$bvToast.toast(message, {
        title: title,
        toaster: 'b-toaster-top-right',
        variant: 'success',
        solid: true,
        static: true,
        appendToast: false,
        autoHideDelay: 2000
      })
    },
    createErrorToast: function (message, title) {
      this.$bvToast.toast(message, {
        title: title,
        toaster: 'b-toaster-top-right',
        variant: 'danger',
        solid: true,
        static: true,
        appendToast: false,
        noAutoHide: true
      })
    }
  }
})
