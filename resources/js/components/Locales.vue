<template>
  <div>
    <div v-if="type=='navbar'">
    <fa :icon="icon" />
      <a v-for="(value, key) in locales" :key="key" href="#"
          @click.prevent="setLocale(key)">
        <span v-if="key !== locale" class="show-dekstop">{{ $t(key) }}</span>
        <span v-if="key !== locale" class="show-mobile display-inline-flex">{{ $t(key+'_short') }}</span>
      </a>
    </div>
    <div v-else>
      <fa :icon="icon" class="fa-2x sidebar-icon py-2 c-white" style="display: inline-flex;"  />
      <a v-for="(value, key) in locales" :key="key" class="dark-gray-color" href="#"
          @click.prevent="setLocale(key)">
        <span v-if="key !== locale" class="show-dekstop">{{ $t(key) }}</span>
        <span v-if="key !== locale" class="show-mobile display-inline-flex">{{ $t(key+'_short') }}</span>
      </a>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  props: {
    type: {
      type: String,
      required: false,
      default: 'default' // default is sidebar
    },
    icon: {
      type: String,
      required: false,
      default: 'globe-europe'
    }
  },

  methods: {
    created() {

    },
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)
        console.log(this.locale, this.locales);
        this.$store.dispatch('lang/setLocale', { locale })
      }
    }
  }
}
</script>
