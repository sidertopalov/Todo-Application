<template>
  <div class="main-wrapper h-100 mw-100">
     <div class="row">
      <router-link :to="{ name: 'welcome' }" class="w-100 pt-20">
        <v-button>
          <fa icon="home" />
          <span class="sidebar-text">{{ $t("go_home") }}</span>
        </v-button>
      </router-link>
    </div>

    <div class="row h-100">

      <div class="col-lg-8 m-auto d-flex justify-content-center align-items-center flex-column h-100">
        <div class="row">
            <b-card
              border-variant="primary"
              :header="$t('login')"
              header-bg-variant="primary"
              header-text-variant="white"
              align="center">

              <form @submit.prevent="login" @keydown="form.onKeydown($event)" class="d-flex flex-column align-items-center w-330p">
                  <!-- Username -->
                  <div class="form-group row w-100">
                    <div class="w-100">
                      <input v-model="form.email"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        class="form-control br-5"
                        type="text"
                        name="email"
                        v-bind:placeholder="$t('email')">
                      <has-error :form="form" field="email" />
                    </div>
                  </div>

                  <!-- Password -->
                  <div class="form-group row w-100">
                    <div class="w-100">
                      <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control br-5" type="password" name="password" v-bind:placeholder="$t('password')">
                      <has-error :form="form" field="password" />
                    </div>
                  </div>

                  <!-- Remember Me -->
                  <div class="form-group row w-100">
                    <div class="col-md-6 d-flex p-0">
                      <router-link :to="{ name: 'password.request' }" class="small">
                        {{ $t('forgot_password') }}
                      </router-link>
                    </div>
                  </div>

                  <!-- Login Button -->
                  <div class="form-group row w-100">
                    <div class="col-sm-7 d-flex p-0">
                      <v-button :loading="form.busy" class="br-5">
                        <fa icon="sign-in-alt" />
                        {{ $t('login') }}
                      </v-button>
                    </div>
                  </div>
                </form>
            </b-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
import Cookies from 'js-cookie'
import AppFooter from '~/components/AppFooter'

export default {
  layout: 'basic',
  middleware: 'guest',

  components: {
    AppFooter
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/v1/security/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
