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

      <!-- Guess links -->
      <div v-if="!authenticated">
        <li class="mb-1">
          <router-link :to="{ name: 'login' }" v-on:click.native="toggleSidebar(false)">
            <fa icon="sign-in-alt" class="fa-2x sidebar-icon py-2" />
            <span class="sidebar-text">{{ $t("login") }}</span>
          </router-link>
        </li>

        <li class="mb-1">
          <router-link :to="{ name: 'register' }" v-on:click.native="toggleSidebar(false)">
            <fa icon="user-plus" class="fa-2x sidebar-icon py-2" />
            <span class="sidebar-text">{{ $t("register") }}</span>
          </router-link>
        </li>
      </div>

      <!-- Authenticated links -->
      <div v-else>
        <!-- Profile  -->
        <li class="mb-1">
          <router-link :to="{ name: 'settings.profile' }" v-on:click.native="toggleSidebar(false)">
            <b-avatar :text="this.userInitials" class="sidebar-avatar"></b-avatar>
            <span class="sidebar-text">
              {{ $t("profile.profile") }}
              <span class="font-italic">({{ user.name }})</span>
            </span>
          </router-link>
        </li>
        <hr />

        <li class="mb-1">
          <router-link :to="{ name: 'tasks.index' }" v-on:click.native="toggleSidebar(false)">
            <fa icon="clipboard-list" class="fa-2x sidebar-icon py-2" />
            <span class="sidebar-text">{{ $t("tasks.todo_list") }}</span>
          </router-link>
        </li>

        <hr />

        <li>
          <a href="#" @click.prevent="logout" @click="toggleSidebar(false)">
            <fa icon="door-open" class="fa-2x sidebar-icon py-2" />
            <span class="sidebar-text">{{ $t("logout") }}</span>
          </a>
        </li>

      </div>
    </ul>

    <locales class="small force-bottom w-250p mb-1"></locales>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
import Locales from '~/components/Locales';

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
