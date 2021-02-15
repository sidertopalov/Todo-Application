<template>
  <div class="main-layout">

    <div class="show-mobile">
      <b-nav class="app-navigator box-shadow justify-content-between">
        <b-nav-item @click="toggleSidebar(true)">
          <fa class="fa-2x sidebar-icon py-2" icon="bars"  />
        </b-nav-item>

        <!-- <div class="d-flex"> -->
          <!-- <template v-if="authenticated">
            <b-nav-item>
              <router-link :to="{ name: 'home' }">
                {{ $t('home') }}
              </router-link>
            </b-nav-item>
          </template>
          <template v-else>
            <b-nav-item>
              <router-link :to="{ name: 'login' }">
                {{ $t('login') }}
              </router-link>
            </b-nav-item>
            <b-nav-item>
              <router-link :to="{ name: 'register' }">
                {{ $t('register') }}
              </router-link>
            </b-nav-item>
          </template> -->

          <!-- <b-nav-item>
            <locales type="navbar"></locales>
          </b-nav-item> -->
        <!-- </div> -->
      </b-nav>
    </div>

    <!-- <navbar /> -->
    <sidebar class="show-dekstop" ref="sidebar" />

    <div class="container mt-4">
      <child />
    </div>

    <app-footer />
  </div>
</template>

<script>

import Sidebar from '~/components/Sidebar'
import AppFooter from '~/components/AppFooter'
import Locales from '~/components/Locales'
import { mapGetters } from 'vuex'

export default {
  name: 'MainLayout',


  components: {
    Sidebar,
    AppFooter,
    Locales
  },

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
  methods: {
    showSidebar() {
      console.log('show sidebar', this.$refs['sidebar'].$el.classList.toggle('expanded'));
    }
  }
}
</script>
