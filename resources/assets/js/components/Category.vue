<template>
  <div class="Category">
    <div class="Category__main">
      <a class="Category__name" v-link="{ name: 'category', params: { categoryId: category.id } }">
        {{ category.name }}
      </a>
      <div class="Category__meta">
        <span class="Category__description">{{ category.description }}</span>
      </div>
    </div>
    <div class="Category__stats">
      <span class="Category__comments">
        <span class="Category__stat-number">
          {{ category.numberOfPosts }}
        </span>
        <small class="Category__stat-label">
          Posts
        </small>
      </span>
    </div>
  </div>
</template>

<script>
export default {

  props: ['category']
}
</script>

<style lang="stylus">
.Category
  margin-bottom: 5px
  padding: 20px
  border: 1px solid #ddd
  border-radius: 1px
  display: flex
  justify-content: space-between
  align-items: center

  &:hover
    &:before
      background: deepskyblue
  
  &:before
    content: ' '
    width: 5px
    height: 40px
    background: gainsboro
    margin-right: 10px


.Category__meta
  margin-top: 5px
  font-size: 14px
  font-weight: lighter
  color: #999

.Category__description:before
  display: none

.Category__main
  flex: 1
  padding-right: 20px

.Category__stats
  display: flex
  flex-direction: column
  justify-content: center
  align-items: center

.Category__name
  font-family: "Roboto", sans-serif
  font-weight: normal
  font-size: 18px
  text-decoration: none
  color: #333

  &:hover
    text-decoration: underline
    
</style>

