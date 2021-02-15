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
        autoHideDelay: 3000
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
    },
    redirectWithSuccessToastMessage: function (route, message, title) {
      let vm = this
      this.$router.push({ name: route }, () => {
        setTimeout(() => {
          vm.createSuccessToast(message, title)
        }, 1000)
      })
    },
    redirectWithSuccessToastMessageToRouteWithParam: function (route, message, title, paramId) {
      let vm = this
      this.$router.push({
        name: route,
        params: { id: paramId }
      }, () => {
        setTimeout(() => {
          vm.createSuccessToast(message, title)
        }, 1000)
      })
    },
    redirectWithErrorToastMessage: function (route, message, title) {
      let vm = this
      this.$router.push({ name: route }, () => {
        setTimeout(() => {
          vm.createErrorToast(message, title)
        }, 1000)
      })
    }
  }
})
