<template>
<modal title="New Topic">
  <form class="Modal__form" @submit.prevent="createTopic">
    <input v-model="newTopic.category_id" type="hidden" name="category_id">
    <input v-model="newTopic.title" type="text" name="title" placeholder="Title" required>
    <textarea v-model="newTopic.body" name="body" placeholder="Content" required></textarea>
    <button class="Button Modal__button">
      Create
      <div v-if="showLoader" class="loader-inner ball-clip-rotate">
        <div></div>
      </div>
    </button>
  </form>
</modal>
</template>

<script>
import Modal from './Modal.vue'
import topicServices from '../services/TopicServices';

export default {

  props: {
    categoryId: Number
  },

  components: { Modal },

  watch: {
    categoryId ( newVal ) {
      this.newTopic.category_id = newVal;
    }
  },

  data () {
    return {
      newTopic: { title: '', body: '', category_id: 0 },
      showLoader: false
    }
  },

  methods: {
    createTopic () {
      this.showLoader = true;

      topicServices.create(this.newTopic)
        .then(topic => {
          this.$dispatch('topicWasCreated', topic.data);
          this.showLoader = false;
          this.$root.modalIsOpen = false;
        });
      
      // Clear inputs
      this.newTopic.title = '';
      this.newTopic.body = '';
    }
  }
}
</script>
