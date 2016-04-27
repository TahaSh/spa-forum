<template>
  <div class="category-view">
    <new-topic-modal :category-id="categoryId"></new-topic-modal>
    <button class="Button" v-if="$root.user.authenticated" @click="showModal">New Topic</button>
    <button class="Button" v-else v-link="{ name:'login' }">Login to post</button>
    <topic
      v-for="topic in topics"
      :topic="topic"
      track-by="id">
    </topic>
    <div class="Pagination">
      <a
        v-if="+page-1 >= 1"
        v-link="{ name: 'category', params: { categoryId: categoryId }, query: { page: +page - 1 }}"
        class="Page-link Page-link--prev">
        Back
      </a>
      <a
        v-if="+page+1 <= lastPage"
        v-link="{ name: 'category', params: { categoryId: categoryId }, query: { page: +page + 1 }}"
        class="Page-link Page-link--next">
        Next
      </a>
    </div>
  </div>
</template>

<script>
import Topic from './Topic.vue';
import NewTopicModal from './NewTopicModal.vue';
import topicServices from '../services/TopicServices';

export default {

  components: { Topic, NewTopicModal },

  data () {
    return {
      topics: [],
      categoryId: 0,
      page: 1,
      lastPage: 1
    }
  },

  methods: {
    showModal () {
      this.$root.showModal();
    }
  },

  events: {
    topicWasCreated (topic) {
      this.topics.unshift(topic);
    }
  },

  watch: {
    'topics' () {
      let breadcrumbs = this.topics[0].breadcrumbs;
      breadcrumbs.pop();
      this.$root.breadcrumbs = breadcrumbs;
    }
  },

  route: {
    data ({ to }) {
      this.page = to.query.page || 1;
      this.categoryId = +to.params.categoryId;
      return topicServices.getAllInCategory(this.categoryId, this.page)
        .then(({ data }) => ({
          topics: data.data,
          lastPage: data.last_page 
        }));
    }
  }
}
</script>

<style lang="stylus">
.Button
  border: none
  background: deepskyblue
  color: white
  font-wight: light
  font-family: 'Roboto'
  padding: 10px
  border-radius: 1px
  margin-bottom: 20px
  margin-top: 5px
  &:hover
    background: darken(deepskyblue, 10%)

.Pagination
  display: flex;
  justify-content: center;
  margin-top: 20px;
  margin-bottom: 20px;

.Page-link
  text-decoration: none
  color: deepskyblue
  padding: 11px
  display: flex
  justify-content: center
  align-items: center
  width: 80px
  height: 30px
  

  &:hover
    background: deepskyblue
    color: white
    border-radius: 1px
    border: none

.Page-link--prev:before
  content: '◀'
  font-size: 14px
  padding: 1px
  position: relative
  top: 1px
  left: -4px

.Page-link+.Page-link
  border-left: 1px solid deepskyblue

.Page-link:hover+.Page-link
  border: white

.Page-link--next:after
  content: '▶'
  padding: 1px
  font-size: 14px
  position: relative
  top: 1px
  left: 4px

</style>

