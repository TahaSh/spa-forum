<template>
  <div class="topic-view" v-show="!$loadingRouteData">
    <edit-topic-modal :topic="topic"></edit-topic-modal>
    <div class="Full-topic" v-if="topic">
      <h1 class="Full-topic__title">
        {{ topic.title }}
      </h1>
      <div class="Full-topic__meta">
        <span class="Full-topic__author">by {{topic.user.name}}</span>
        <span class="Full-topic__time">{{ topic.time | fromNow }}</span>
        <div class="Full-topic__options" v-if="owner">
          <a class="Full-topic__edit" @click="editTopic">
            <i class="icon material-icons">mode_edit</i>
          </a>
          <a class="Full-topic__delete" @click="deleteTopic">
            <i class="icon material-icons">delete</i>
          </a>
        </div>
      </div>
      <p class="Full-topic__body">
        {{ topic.body }}
      </p>
    </div>
    <hr class="Full-topic__separator">
    <comments
      v-if="topic"
      :comments="topic.comments"
      :topic-id="topic.id">
    </comments>
  </div>
</template>

<script>
import topicServices from '../services/TopicServices';
import EditTopicModal from './EditTopicModal.vue';
import Comments from './Comments.vue';
import swal from 'sweetalert';

export default {

  components: { EditTopicModal, Comments },

  data () {
    return {
      topic: null,
      comments: []
    }
  },

  computed: {
    owner () {
      return this.topic.user.id == this.$root.user.id;
    }
  },

  methods: {
    editTopic () {
      this.$root.showModal();
    },

    deleteTopic () {
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this topic!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      }, () => {
        topicServices.delete(this.topic.id)
          .then(() => {
            swal("Deleted!", "Your topic has been deleted.", "success");
            this.$router.go({ name: 'category', params: { categoryId: +this.topic.category_id } });
          });
      });
    },

    incrementViews() {
      this.topic.views++;
      topicServices.updateViews(this.topic);
    }
  },

  watch: {
    'topic' () { 
      this.incrementViews();
      this.$root.breadcrumbs = this.topic.breadcrumbs;
    }
  },

  events: {
    commentWasCreated (comment) {
      this.comments.push(comment);
    }
  },

  route: {
    data ({ to }) {
      return topicServices.find(to.params.topicId)
        .then(({ data }) => ({ 
          topic: data,
          comments: data.comments
        }));
    }
  }
}
</script>

<style lang="stylus">
.Full-topic
  padding: 10px 50px

.Full-topic__title
  font-size: 30px
  margin-bottom: 0

.Full-topic__meta
  margin-top: 10px
  color: #999

  .icon
    font-size: 20px
    cursor: pointer
    position: relative
    top: 3px
    &:hover
      color: deepskyblue

.Full-topic__time:before
  content: '•'
  margin-right: 5px

.Full-topic__delete:before
  content: '/'
  margin-right: 5px

.Full-topic__body
  margin-top: 30px
  font-size: 17px

.Full-topic__edit:before
  content: '('

.Full-topic__delete:after
  content: ')'

.Full-topic__options
  display: inline-block
  margin-left: 2px

.Full-topic__separator
  border: none
  border-bottom: 1px dashed #eee
  width: 95%
  margin: 30px auto
  
</style>
