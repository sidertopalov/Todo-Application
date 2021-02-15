<template>
	<footer class="app-footer text-center small box-shadow">
		<div class="container">
			<span class="text-muted">
				@ 2021-{{ new Date().getFullYear() }}
			</span>
		</div>
	</footer>
</template>

<script>
// import { mapGetters } from "vuex";

export default {
  name: "AppFooter"
};
</script>
