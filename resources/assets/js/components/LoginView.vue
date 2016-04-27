<template>
  <div class="login-view">
    <div class="Login-alert" v-show="authError" transition="fade">
      Wrong email / password combination
    </div>
    <h1 class="Login-title">Login</h1>
    <form class="Login-form" @submit.prevent="login">
      <input
        type="email"
        name="email"
        class="Login-form__input"
        v-model="creds.email"
        placeholder="Email" required>
      <input
        type="password"
        name="password"
        class="Login-form__input"
        v-model="creds.password"
        placeholder="Password" required>
      <button type="submit" class="Button Login-form__button">
        Login
      </button>
    </form>
  </div>
</template>

<script>

import auth from '../services/Auth';

export default {

  data () {
    return {
      creds: {
        email: '',
        password: ''
      },
      authError: false
   }
  },

  methods: {
    login () {
      auth.login(this, this.creds);
      this.creds = { email: '', password: '' };
    },

    showError () {
      this.authError = true;
    },

    hideError () {
      this.authError = false;
    }
  },

  route: {
    activate () {
      this.$root.breadcrumbs = [];
      this.hideError();
    }
  }
}
</script>

<style lang="stylus">
.login-view
  display: flex
  width: 500px
  justify-content: center
  align-items: center
  margin: 0 auto
  flex-wrap: wrap

.Login-form
  display: flex
  justify-content: center
  align-items: center
  flex-wrap: wrap
  margin-top: 5px

.Login-form__input
  flex-basis: 100%
  height: 40px
  padding: 10px
  border-radius: 1px
  border: 1px solid #eee
  margin-top: 15px

  &:hover, &:active, &:focus
    border: 1px solid darken(#eee, 10%)
    box-shadow: none
    outline: none

.Login-form__button
  margin-top: 15px

.Login-title
  margin: 0
  font-family: 'Lato', sans-serif
  font-weight: 300
  font-size: 50px
  text-transform: uppercase

.Login-alert
  border: 2px solid orangered
  padding: 10px
  border-radius: 2px
  width: 90%
  text-align: center
  margin-bottom: 20px
  color: orangered
</style>

