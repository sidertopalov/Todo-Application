<template>
  <form @submit.prevent="addTodo()">
    <input
      v-model="form.description"
      type="text"
      class="form-control"
      placeholder="Create a new to-do..."
    />
  </form>
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
          console.log(response);
          this.$emit("on-new-todo", response.data.data);
          this.form.description = "";
        }).catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style lang="scss" scoped></style>
