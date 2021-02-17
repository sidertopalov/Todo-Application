<template>

  <a class="d-flex align-items-center list-group-item" :class="{ 'list-group-item-primary': completed }">
    <b-button
      v-if="!isEditing"
      class="border-0 flex-grow-1 text-left shadow-none bg-inherit"
      :class="{ 'completed': completed }"
      @click="$emit('on-toggle')"
     >
      <span>{{ description }}</span>
    </b-button>

    <form v-else class="flex-grow-1" @submit.prevent="finishEditing()">
      <input
        v-if="newTodoDescription.length <= elementSwapDelimitation"
        type="text"
        class="form-control"
        v-model="newTodoDescription"
        ref="newTodo"
      />
      <b-form-textarea
        v-else
        id="textarea"
        v-model="newTodoDescription"
        placeholder="Enter something..."
        rows="3"
        max-rows="6"
        ref="newTodo"
      ></b-form-textarea>
    </form>

    <b-button
      variant="outline-primary"
      class="border-0 ml-2"
      @click="startEditing()"
    >
      <fa icon="edit"/>
    </b-button>

    <b-button
      variant="outline-danger"
      class="border-0"
      @click="$emit('on-delete')"
    >
      <fa icon="trash"/>
    </b-button>
  </a>

</template>

<script>
export default {
  data() {
    return {
      elementSwapDelimitation: 60,
      isEditing: false,
      isInputElem: true,
      newTodoDescription: ""
    };
  },
  props: {
    description: String,
    completed: Boolean
  },
  watch: {
    "newTodoDescription": function(value) {
      if(this.isInputElem && value.length > this.elementSwapDelimitation) {
        // show textarea element
        this.isInputElem = false;
        this.$nextTick(() => this.$refs.newTodo.focus());
      } else if(!this.isInputElem && value.length <= this.elementSwapDelimitation) {
        // show input element
        this.isInputElem = true;
        this.$nextTick(() => this.$refs.newTodo.focus());
      }
    }
  },
  methods: {
    startEditing() {
      if (this.isEditing) {
        this.finishEditing();
      } else {
        this.newTodoDescription = this.description;
        this.isEditing = true;
        this.$nextTick(() => this.$refs.newTodo.focus());
      }
    },
    finishEditing() {
      this.isEditing = false;
      this.$emit("on-edit", this.newTodoDescription);
    }
  }
};
</script>

<style lang="scss" scoped>
.completed {
  text-decoration: line-through;
}
</style>
