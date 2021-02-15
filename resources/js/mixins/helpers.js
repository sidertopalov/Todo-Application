import Vue from 'vue';

Vue.mixin({
  methods: {
    userHavePermission(name) {
      return true;
    },
    toggleSidebar(show) {
      if(!this.$refs.sidebar) {
        return;
      }
      if(show) {
        this.$refs.sidebar.$el.classList.add('expanded')
      } else {
        this.$refs.sidebar.classList.remove('expanded');
      }
    },
  }
});
