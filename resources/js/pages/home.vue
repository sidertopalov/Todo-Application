<template>
	<card :title="$t('home')">
		<h5 v-if="user">
			{{ $t("hello_with_comma") }} {{ user.name }}
		</h5>
			{{ $t("you_are_logged_in") }}
	</card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",

	metaInfo() {
		return { title: this.$t("home") };
  },

	computed: mapGetters({
		user: "auth/user",
	}),
};
</script>
