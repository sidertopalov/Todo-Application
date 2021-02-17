<template>
  <b-form @submit.prevent="addTodo()">
    <b-form-input
      id="description"
      v-model="form.description"
      type="text"
      class="form-control"
      required
      :placeholder="$t('tasks.create_todo_text')"
      :class="{ 'is-invalid': form.errors.has('description') }"
    />
    <has-error :form="form" field="description" />
  </b-form>
</template>

<script>
import Form from "vform";

export default {
  data() {
    return {
      form: new Form({
        description: ""
      })
    };
  },
  methods: {
    addTodo() {
      this.form
        .post('/api/v1/tasks/tasks')
        .then(response => {
          this.$emit("on-new-todo", response.data.data);
          this.form.description = "";
        }).catch(error => {
          this.handleErrors(error);
        });
    }
  }
};
</script>

<style lang="scss" scoped></style>
