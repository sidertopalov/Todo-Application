<template>
  <div>
    <div class="pbt-15">
      <b-overlay class="container-items" :show="loading" rounded="sm">
        <slot />
      </b-overlay>
    </div>

    <b-row class="pagination-container justify-content-center align-items-center" v-if="allResultsCount > 0">
      <b-col>
        <hr />
      </b-col>
      <b-col>
        <b-pagination
          align="center"
          v-model="currentPage"
          :total-rows="allResultsCount"
          :per-page="showResultsPerPages"
          limit="5"
          first-number
          last-number
        ></b-pagination>
      </b-col>
      <b-col>
        <hr />
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from "axios";

export default {
  components: {

  },
  name: "SmartDataListing",
  props: {
    apiGetCallUrl: {
      type: String,
      required: true
    },
    showResultsPerPages: {
      default: 5
    }
  },
  data: () => ({
    allResultsCount: 0,
    isLoading: true,
    currentPage: 1
  }),
  computed: {
    loading() {
      return this.isLoading;
    }
  },
  watch: {
    currentPage: function() {
      this.ajaxUpdateResults();
    },
    apiGetCallUrl: function() {
      this.ajaxUpdateResults();
    }
  },
  created() {

  },
  mounted() {
    this.ajaxUpdateResults();
  },
  methods: {
    ajaxUpdateResults() {
      this.isLoading = true;
      let offset = this.showResultsPerPages * this.currentPage - this.showResultsPerPages;

      return axios
        .get(
          this.apiGetCallUrl +
            "?limit=" +
            this.showResultsPerPages +
            "&offset=" +
            offset
        )
        .then(response => {

          this.isLoading = false;
          this.allResultsCount = response.data.data.meta.total;

          this.$emit(
            "__smartDataListingUpdateResults",
            response.data.data
          );
        })
        .catch(error => {
          this.isLoading = false;
        });
    }
  }
};
</script>

<style scoped>
#header {
  margin-top: 15px;
}
</style>
