<template>
	<card :title="$t('home')">
		Tasks create
	</card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",

	metaInfo() {
		return { title: this.$t("tasks.create") };
  },

	computed: mapGetters({
		user: "auth/user",
  }),

};
</script>
