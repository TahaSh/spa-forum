<template>
<modal title="Edit Topic">
  <form class="Modal__form" @submit.prevent="updateTopic">
    <input type="hidden" name="category_id" v-model="currentTopic.category_id">
    <input type="text" name="title" v-model="currentTopic.title" placeholder="Title" required>
    <textarea name="body" v-model="currentTopic.body" placeholder="Content" required></textarea>
    <button class="Button Modal__button">
      Save
      <div class="loader-inner ball-clip-rotate" v-if="showLoader">
        <div></div>
      </div>
    </button>
  </form>
</modal>
</template>

<script>
import Modal from './Modal.vue';
import topicServices from '../services/TopicServices';

export default {

  props: ['topic'],

  components: { Modal },

  watch: {
    topic ( newVal ) {
      this.currentTopic = newVal;
    }
  },
  
  data () {
    return {
      currentTopic: {},
      showLoader: false
    }
  },

  methods: {
    updateTopic () {
      this.showLoader = true;
      topicServices.update(this.currentTopic)
        .then(topic => {
          this.$dispatch('topicWasUpdated', topic.data);
          this.showLoader = false;
          this.$root.modalIsOpen = false;
        });
    }
  }
}
</script>
