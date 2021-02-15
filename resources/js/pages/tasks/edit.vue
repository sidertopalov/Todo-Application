<template>
	<card :title="$t('home')">
		Tasks edit
	</card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",

	metaInfo() {
		return { title: this.$t("tasks.edit") };
  },

	computed: mapGetters({
		user: "auth/user",
  }),

};
</script>
