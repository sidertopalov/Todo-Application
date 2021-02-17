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
              :id="task.id"
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

  data: () => ({
    isFetchingFromDb: false,
    currentDescription: null,
    currentStatusId: null,
    resultsPerPages: 5,
    tasks: []
  }),

  methods: {
    isTaskCompleted(task) {
      return task.status.id == 1 ? false : true;
    },
    addTodo(newTask) {
      this.$refs['smartDataListing'].allResultsCount++;
      // Update result only if the user is on the first page
      if(this.$refs.smartDataListing.currentPage == 1) {
        this.tasks.unshift(newTask);

        if(this.tasks.length > this.resultsPerPages) {
          this.tasks.pop();
        }
      }
    },
    deleteTodo(deletedTask) {

      this.isFetchingFromDb = true;
      axios
        .delete('/api/v1/tasks/tasks/'+deletedTask.id)
        .then(response => {
          let data = response.data.data;
          console.log(data);
          this.$refs['smartDataListing'].ajaxUpdateResults();

          this.isFetchingFromDb = false;

          this.createSuccessToast(
            this.$t("tasks.todo_delete_success"),
            this.$t("success")
          );

        }).catch(error => {
          this.isFetchingFromDb = false;
          console.log(error);
          this.createErrorToast(
            this.$t("tasks.todo_delete_failed"),
            this.$t("warning")
          );
        });
    },
    toggleTodo(task) {
      if(this.isFetchingFromDb) {
        return;
      }

      this.updateTodo(task, {
        id: task.id,
        description: task.description,
        status_id: task.status_id == 1 ? 2 : 1
      });
    },
    editTodo(task, newTaskDescription) {
      if(this.isFetchingFromDb || task.description === newTaskDescription) {
        return;
      }

      this.updateTodo(task, {
        id: task.id,
        description: newTaskDescription,
        status_id: task.status_id
      });
    },
    updateTodo(task, newData) {
      this.isFetchingFromDb = true;

      this.currentDescription = task.description;
      this.currentStatusId = task.status_id;

      task.description = newData.description;
      task.status_id = newData.status_id;

      axios
        .patch('/api/v1/tasks/tasks/'+task.id, newData)
        .then(response => {
          let data = response.data.data;

          task.description = data.description;
          task.status_id = data.status_id;
          task.status = data.status;

          this.isFetchingFromDb = false;

          this.createSuccessToast(
            this.$t("tasks.todo_update_success"),
            this.$t("success")
          );

        }).catch(error => {
          this.isFetchingFromDb = false;
          task.description = this.currentDescription;
          task.status_id = this.currentStatusId;

          this.createErrorToast(
            this.formatErrors(error),
            this.$t("warning")
          );
        });
    },
    updateUserTasks(data) {
      this.tasks = data.result;
    }
  }

};
</script>
