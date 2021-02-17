<template>
  <div>
    <a class="d-flex align-items-center list-group-item" :class="{ 'list-group-item-primary': completed }">

      <b-button
        v-if="!isEditing"
        class="border-0 flex-grow-1 text-left shadow-none bg-inherit"
        :class="{ 'completed': completed }"
        @click="$emit('on-toggle')"
      >
        <span class="text-break">{{ description }}</span>
      </b-button>

      <form v-else class="flex-grow-1" @submit.prevent="finishEditing()">
        <input
          v-if="isEditing && newTodoDescription.length <= elementSwapDelimitation"
          type="text"
          class="form-control"
          v-model="newTodoDescription"
          ref="newTodo"
          v-on:keyup.enter="finishEditing"
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

        <div class="mt-3 text-right" v-if="isEditing && newTodoDescription.length > elementSwapDelimitation">
          <b-button-group size="md">
             <b-button type="submit" variant="primary">{{ $t('save') }}</b-button>
          </b-button-group>
        </div>
      </form>

      <b-button
        id="todo_edit"
        variant="outline-primary"
        class="border-0 ml-2"
        @click="startEditing()"
      >
        <fa icon="edit"/>
      </b-button>
      <b-tooltip target="todo_edit" :title="$t('tasks.tooltips.edit')"></b-tooltip>

      <b-button
        id="todo_delete"
        variant="outline-danger"
        class="border-0"
        @click="$bvModal.show('confirm-delete'+ id)"
      >
        <fa icon="trash"/>
      </b-button>
      <b-tooltip target="todo_delete" :title="$t('tasks.tooltips.delete')"></b-tooltip>

      <b-modal :id="'confirm-delete'+ id"
        :title="$t('warning')"
        :ok-title="$t('delete')"
        ok-variant="danger"
        :cancel-title="$t('cancel')"
        @ok="$emit('on-delete')"
        @hidden="$bvModal.hide('confirm-delete'+ id)"
        >
          {{ $t('tasks.delete_text') }}
      </b-modal>
    </a>
  </div>

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
    id: Number,
    description: String,
    loading: Boolean,
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
