<template>
  <div class="Comments">
    <h1 class="Comments__header">Comments</h1>
    <comment
      v-for="comment in comments"
      :comment="comment">
    </comment>
    <div class="Comments__empty-msg" v-if="!comments.length">Nothing to show!</div>
    <form class="Comments__form" v-if="$root.user.authenticated" @submit.prevent="submitComment">
      <textarea
        class="Comments__form-textarea"
        name="body"
        v-model="newComment.body"
        placeholder="Your comment..."
        required>
      </textarea>
      <button class="Button" type="submit">Comment</button>
    </form>
    <button class="Comments__login-button Button" v-link="{ name: 'login' }" v-else>
      Login to comment
    </button>
  </div>
</template>

<script>
import Comment from './comment.vue';
import commentServices from '../services/CommentServices';

export default {

  components: { Comment },

  props: ['comments', 'topicId'],

  ready () {
    this.newComment.topic_id = this.topicId;
  },

  watch: {
    topicId (newVal) {
      this.newComment.topic_id = newVal;
    }
  },

  data () {
    return {
      newComment: { body: '', topic_id: 0 }
    }
  },

  methods: {
    submitComment () {
      commentServices.addCommentToTopic(this.topicId, this.newComment)
        .then(({data}) => {
          this.$dispatch('commentWasCreated', data);
          this.newComment.body = '';
        });
    }
  }
}
</script>

<style lang="stylus">
.Comments
  padding: 5px 50px
  width: 100%
  margin: 0 auto

.Comments__header
  margin: 0
  font-size: 25px
  font-weight: 400

.Comments__form
  display: flex
  flex-wrap: wrap
  padding: 30px
  margin: 0 auto

.Comments__form-textarea
  flex-basis: 100%
  border: 1px solid #eee
  padding: 10px
  margin-bottom: 10px
  height: 200px

  &:hover, &:active, &:focus
    border: 1px solid darken(#eee, 10%)
    box-shadow: none
    outline: none

.Comments__login-button.Button
  margin-top: 20px

.Comments__empty-msg
  margin-top: 10px
  margin-left: 10px

</style>
