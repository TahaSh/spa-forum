<template>
  <div class="Comment">
    <div class="Comment__meta">
      <div class="Comment__author">
        {{ comment.user.name }}
      </div>
      <div class="Comment__time">
        ({{ comment.time | fromNow }}):
      </div>
    </div>
    <div class="Comment__body">
      {{ comment.body }}
    </div>
  </div>
</template>

<script>
export default {

  props: ['comment']
}
</script>

<style lang="stylus">
.Comment
  padding: 20px 10px
  border: 1px solid #eee
  margin: 15px auto 0

.Comment__author
  margin-bottom: 11px
  margin-right: 10px
  font-size: 16px
  font-weight: 500

.Comment__meta
  display: flex
  color: #999

.Comment__body
  padding-top: 5px
  
</style>

