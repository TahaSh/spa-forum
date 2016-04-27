import Vue from 'vue';

export default {

  getAll () {
    return Vue.http.get('/api/categories');
  }
}
