<template>
	<div>
    <b-container fluid>
      <b-row class="mtb-20 text-center">
        <b-col>
          <h2>{{ $t('tasks.todo_list') }}</h2>
        </b-col>
      </b-row>
    </b-container>

    <div class="row justify-content-center mb-4 br-5">
      <div class="col-6">
        <create-todo @on-new-todo="addTodo($event)" />
      </div>
    </div>

    <smart-data-listing
        ref="smartDataListing"
        :api-get-call-url="apiGetUserTasksUrl"
        :show-result-per-page="resultsPerPages"
        @__smartDataListingUpdateResults="updateUserTasks"
      >
      <div class="row" v-if="tasks.length > 0">
        <div class="col">
          <ul class="list-group br-5">
            <todo
              v-for="task in tasks"
              :key="task.id"
              :description="task.description"
              :completed="(task.status_id != 1)"
              @on-toggle="toggleTodo(task)"
              @on-delete="deleteTodo(task)"
              @on-edit="editTodo(task, $event)"
            />
          </ul>
        </div>
      </div>
      <div class="row d-block text-center text-muted" v-else>
        List empty.
      </div>
    </smart-data-listing>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";
import CreateTodo from "~/components/CreateTodo";
import Todo from "~/components/Todo";
import SmartDataListing from "~/components/SmartDataListing";

export default {
  middleware: "auth",

  components: {
    CreateTodo, Todo, SmartDataListing
  },

	metaInfo() {
		return { title: this.$t("tasks.todo_list") };
  },

	computed: {
    ...mapGetters({
      authenticated: "auth/check",
      user: "auth/user"
    }),

    apiGetUserTasksUrl: function() {
      return "/api/v1/tasks/get-user-tasks";
    }
  },

  created() {

  },

  data: () => ({
    isFetchingFromDb: false,
    resultsPerPages: 5,
    tasks: []
  }),

  methods: {
    isTaskCompleted(task) {
      return task.status.id == 1 ? false : true;
    },
    addTodo(newTask) {
      // Update result only if the user is on the first page
      if(this.$refs.smartDataListing.currentPage == 1) {
        this.tasks.unshift(newTask);
        console.log(newTask, this.tasks);

        if(this.tasks.length > this.resultsPerPages) {
          this.tasks.pop();
        }
      }
    },
    toggleTodo(task) {
      task.status_id = task.status_id == 1 ? 2 : 1;
    },
    deleteTodo(deletedTask) {
      this.tasks = this.tasks.filter(task => task !== deletedTask);
    },
    editTodo(task, newTaskDescription) {
      task.description = newTaskDescription;
    },
    updateUserTasks(data) {
      console.log(data);
      this.tasks = data.result;
      // this.isFetchingFromDb = true;
      // axios
      //   .get('/api/v1/tasks/get-user-tasks')
      //   .then(response => {
      //     let data = response.data.data;
      //     console.log(data);
      //     this.tasks = data.result;
      //     this.allResultsCount = data.meta.total;
      //     // this.property_type
      //     this.isFetchingFromDb = false;

      //   }).catch(error => {
      //     this.isFetchingFromDb = false;
      //   });
    }
  }

};
</script>
