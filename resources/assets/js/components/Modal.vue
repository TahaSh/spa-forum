<template>
  <div
    class="Modal u-overlay"
    transition="fade"
    @click="$root.modalIsOpen = false"
    v-show="isModalOpen">
      <div class="Modal__container" @click.stop="" v-show="isModalOpen">
        <header class="Modal__header">
          <h1>{{ title }}</h1>
        </header>
        <div class="Modal__content">
          <slot></slot>
        </div>
        <footer class="Modal__footer"></footer>
      </div>
  </div>
</template>

<script>
export default {

  props: ['title'],

  computed: {
    isModalOpen () {
      return this.$root.modalIsOpen;
    }
  }
}
</script>

<style lang="stylus">
.Modal__container
  max-width: 700px
  width: 90%
  background: white
  border-radius: 2px
  animation-duration: 0.3s
  animation-delay: 0s

.Modal__header
  border-bottom: 1px solid white
  padding: 15px 10px
  background-color: silver
  color: white
  border-radius: 2px

.Modal__header > h1
  font-size: 27px
  font-weight: normal
  margin: 0

.Modal__content
  padding: 10px

.Modal__footer
  padding: 5px

.Modal__form
  display: flex
  flex-wrap: wrap

  & > *
    flex-basis: 100%
    margin-bottom: 20px

  & > input[type=text], & > textarea
    height: 40px
    border-radius: 3px
    border: 1px solid #eee
    padding: 4px

  & > textarea
    height: 200px

.u-overlay
  position: fixed
  z-index: 1000
  top: 0
  left: 0
  width: 100%
  height: 100%
  background-color: rgba(0,0,0,0.8)
  display: flex
  align-items: center
  justify-content: center

.fade-transition
  transition: opacity .2s ease
  &.fade-enter, &.fade-leave
    opacity: 0

.loader-inner.ball-clip-rotate > div
  position: relative
  right: -5px
  top: 2px

.Modal__button
  display: flex
  justify-content: center
  align-items: center
  font-size: 20px

</style>
