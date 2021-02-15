<template>
  <nav class="sidebar shadow" ref="sidebar">
    <ul class="d-flex flex-column">
      <div class="show-mobile c-white" @click="toggleSidebar(false)">
        <fa icon="times-circle" class="fa-2x sidebar-icon py-2" style="position: absolute; right: 20px" />
      </div>
      <li class="mt-50 mb-70">
        <router-link :to="{ name: user ? 'home' : 'welcome' }">
          <fa icon="home" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("home") }}</span>
        </router-link>
      </li>

      <!-- Profile  -->
      <li class="mb-1" v-if="authenticated">
        <router-link :to="{ name: 'settings.profile' }" v-on:click.native="toggleSidebar(false)">
          <b-avatar :text="this.userInitials" class="sidebar-avatar"></b-avatar>
          <span class="sidebar-text">
            {{ $t("profile.profile") }}
            <span class="font-italic">({{ user.name }})</span>
          </span>
        </router-link>
      </li>
      <hr v-if="authenticated" />

      <li class="mb-1" v-if="!authenticated">
        <router-link :to="{ name: 'login' }" v-on:click.native="toggleSidebar(false)">
          <fa icon="sign-in-alt" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("login") }}</span>
        </router-link>
      </li>

      <li class="mb-1" v-if="!authenticated">
        <router-link :to="{ name: 'register' }" v-on:click.native="toggleSidebar(false)">
          <fa icon="user-plus" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("register") }}</span>
        </router-link>
      </li>

      <li class="mb-1" v-if="authenticated">
        <router-link :to="{ name: 'tasks.create' }" v-on:click.native="toggleSidebar(false)">
          <fa icon="plus-circle" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("tasks.create") }}</span>
        </router-link>
      </li>

      <li class="mb-1" v-if="authenticated">
        <router-link :to="{ name: 'tasks.index' }" v-on:click.native="toggleSidebar(false)">
          <fa icon="clipboard-list" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("tasks.all") }}</span>
        </router-link>
      </li>

      <li class="mb-1" v-if="authenticated">
        <router-link :to="{ name: 'tasks.index' }" v-on:click.native="toggleSidebar(false)">
          <fa icon="clipboard-check" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("tasks.completed") }}</span>
        </router-link>
      </li>

      <hr v-if="authenticated" />

      <li v-if="authenticated">
        <a href="#" @click.prevent="logout" @click="toggleSidebar(false)">
          <fa icon="door-open" class="fa-2x sidebar-icon py-2" />
          <span class="sidebar-text">{{ $t("logout") }}</span>
        </a>
      </li>
    </ul>

    <locales class="small force-bottom w-250p mb-1"></locales>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
import Locales from '~/components/Locales'

export default {
  components: {
    Locales
  },
  name: "Sidebar",

  data: () => ({
    appName: window.config.appName,
    userInitials: "",
  }),

  mounted() {
    this.userInitials = this.user && this.user.name ? this.user.name : "";
  },
  computed: mapGetters({
    user: "auth/user",
    authenticated: 'auth/check'
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "welcome" });
    },
  },
};
</script>
