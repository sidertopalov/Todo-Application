<template>
  <div class="main-layout">

    <div>
      <b-nav class="app-navigator box-shadow justify-content-between" v-if="authenticated">
        <b-nav-item @click="toggleSidebar(true)">
          <fa class="show-mobile fa-2x sidebar-icon py-2" icon="bars"  />
        </b-nav-item>

        <b-nav-item>
          	{{ $t("hello_with_comma") }} {{ user.name }}
        </b-nav-item>

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
    authenticated: 'auth/check',
    user: 'auth/user'
  }),
  methods: {
    showSidebar() {
      console.log('show sidebar', this.$refs['sidebar'].$el.classList.toggle('expanded'));
    }
  }
}
</script>
