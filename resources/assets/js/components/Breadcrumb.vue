<template>
  <ol class="Breadcrumbs">
    <li class="Breadcrumb" v-for="breadcrumb in breadcrumbs">
      <a class="Breadcrumb__link" v-link="{ path: breadcrumb.link }" v-if="!currentPage(breadcrumb.link)">
        {{ breadcrumb.name }}
      </a>
      <span class="Breadcrumb__link Breadcrumb__link--inactive" v-else>
        {{ breadcrumb.name }}
      </span>
    </li>
  </ol>
</template>

<script>
export default {

  props: ['breadcrumbs'],

  methods: {
    currentPage (link) {
      return this.$route.path.split('?')[0] == link;
    }
  }
}
</script>

<style lang="stylus">
.Breadcrumbs
  list-style: none
  display: flex
  margin: 0
  margin-bottom: 15px
  padding: 0
  padding-left: 20px;
  margin: 25px 0;

.Breadcrumbs:before
  content: ' '
  display: block
  width: 3px
  background: #f0f0f0
  margin-right: 8px

.Breadcrumb
  &:first-child:before
    display: none
  &:before
    content: '/'
    padding-left: 15px
    padding-right: 15px
    color: gray

.Breadcrumb__link
  color: deepskyblue
  text-decoration: none
  
  &--inactive
    color: gray

</style>
