<template>
	<card :title="$t('home')">
		Tasks index
	</card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",

	metaInfo() {
		return { title: this.$t("tasks.all") };
  },

	computed: mapGetters({
		user: "auth/user",
  }),

};
</script>
