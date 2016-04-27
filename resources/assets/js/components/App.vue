<template>
  <div id="root">
    <header class="Header">
      <h1 v-link="{ name: 'home' }" class="Header__logo">
        SPA-FORUM <small>with vue.js</small>
      </h1>
      <ul class="Header__links">
        <li class="Header__link" v-if="!user.authenticated">
          <a v-link="{ name: 'login' }">Login</a>
        </li>
        <li class="Header__link" v-if="!user.authenticated">
          <a v-link="{ name: 'register' }">Register</a>
        </li>
        <li class="Header__link" v-if="user.authenticated">
          <a href="" @click.prevent="logout">Logout</a>
        </li>
      </ul>
    </header>
    <breadcrumb :breadcrumbs=breadcrumbs></breadcrumb>
    <main>
      <router-view
        class="view"
        keep-alive
        transition
        transition-mode="out-in">
      </router-view>
    </main>
  </div>
</template>

<script>
import Breadcrumb from './Breadcrumb.vue';
import auth from '../services/Auth';

export default {

  components: { Breadcrumb },

  ready () {
    this.user = auth.user;
  },

  data () {
    return {
      breadcrumbs: [],
      modalIsOpen: false,
      user: {}
    }
  },

  methods: {
    showModal () {
      this.modalIsOpen = true;
    },

    logout () {
      auth.logout();
    }
  }
}
</script>

<style lang="stylus">
  *
    box-sizing: border-box

  .view
    margin-top: 12px
    transition: opacity .2s ease
    padding-left: 15px
    padding-right: 15px
    &.v-enter, &.v-leave
      opacity: 0
    
  .Header
    display: flex
    justify-content: space-between
    width: 100%
    border-bottom: 1px #f0f0f0 solid
    padding-left: 20px
  
  .Header__logo
    font-family: "Lato"
    font-weight: 300
    color: #333
    cursor: pointer

    small
      font-size: 18px

  .Header__links
    display: flex
    list-style: none
    padding: 0
    margin: 0
    justify-content: center
    align-items: center

  .Header__link
    margin-right: 20px

    & > a
      color: deepskyblue
      text-decoration: none
      padding-bottom: 8px
      
      &:hover
        border-bottom: 1px solid deepskyblue

</style>

