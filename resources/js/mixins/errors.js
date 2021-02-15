import Vue from 'vue'

Vue.mixin({
  methods: {
    handleErrors: function (error) {
      this.form.errors.errors = {}
      if (error.response.data.messages) {
        for (let message in error.response.data.messages[0]) {
          this.form.errors.errors[message]
            = error.response.data.messages[0][message][0]
        }
      }
    },
    formatErrors (error) {
      let result = ''
      error.response.data.messages.forEach(message => {
        result += message[Object.keys(message)[0]] + ' '
      })
      return result
    }
  }
})
