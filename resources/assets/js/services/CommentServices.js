import Vue from 'vue';

export default {

  addCommentToTopic (topicId, comment) {
    return Vue.http.post(`/api/topics/${topicId}/comments`, comment);
  }
}
