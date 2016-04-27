<template>
  <div class="home-view">
    <div class="Categories">
      <category
        v-for="category in categories"
        :category="category"
        track-by="id">
      </category>
    </div>
  </div>
</template>

<script>
import Category from './Category.vue';
import categoryServices from '../services/CategoryServices';

export default {

  components: { Category },

  data () {
    return {
      categories: []
    }
  },

  route: {
    activate () {
      this.$root.breadcrumbs = [{
        name: 'Categories',
        link: '/'
      }];
    },
    data () {
      return categoryServices.getAll()
        .then(({ data }) => ({
          categories: data
        }));
    }
 },
}
</script>
