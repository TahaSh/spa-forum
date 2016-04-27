<template>
  <div class="Topic">
    <div class="Topic__main">
      <a class="Topic__title" v-link="{ name: 'topic', params: { topicId: topic.id } }">
        {{ topic.title }}
      </a>
      <div class="Topic__meta">
        <span class="Topic__author">by {{ topic.user.name }}</span>
        <span class="Topic__time">{{ topic.time | fromNow }}</span>
      </div>
    </div>
    <div class="Topic__stats">
      <span class="Topic__views">
        <span class="Topic__stat-number">
          {{ topic.views | largeNumbers }}
        </span>
        <small class="Topic__stat-label">
          Views
        </small>
      </span>
      <span class="Topic__comments">
        <span class="Topic__stat-number">
          6
        </span>
        <small class="Topic__stat-label">
          Replies
        </small>
      </span>
    </div>
  </div>
</template>

<script>
export default {

  props: ['topic']
}
</script>

<style lang="stylus">
.Topic
  margin-bottom: 5px
  padding: 20px
  border: 1px solid #ddd
  border-radius: 1px
  display: flex
  justify-content: space-between
  align-items: center

.Topic__meta
  margin-top: 5px
  font-size: 14px
  font-weight: lighter
  color: #999

.Topic__main
  flex: 1
  padding-right: 20px

.Topic__time:before
  content: '•'
  margin-right: 5px

.Topic__stats
  display: flex
  flex-direction: column
  justify-content: center
  align-items: center

.Topic__title
  font-family: "Roboto", sans-serif
  font-weight: normal
  font-size: 18px
  text-decoration: none
  color: #333

  &:hover
    text-decoration: underline
    
</style>
