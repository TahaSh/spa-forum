import Vue from 'vue';

export default {

  getAllInCategory (categoryId, page) {
    return Vue.http.get(`/api/categories/${categoryId}/topics`, { 'page': page });
  },

  create (topic) {
    return Vue.http.post('/api/topics', topic);
  },

  update (topic) {
    return Vue.http.put(`/api/topics/${topic.id}`, topic);
  },

  delete (topicId) {
    return Vue.http.delete(`/api/topics/${topicId}`);
  },

  updateViews (topic) {
    Vue.http.patch(`/api/topics/${topic.id}`, topic);
  },

  find (topicId) {
    return Vue.http.get(`/api/topics/${topicId}`);
  }
}
