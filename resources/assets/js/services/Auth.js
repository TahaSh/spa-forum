import Vue from 'vue';
import {router} from '../main';

export default {

  user: {
    authenticated: false,
    id: 0,
    name: '',
    email: ''
  },

  login (context, creds) {
    Vue.http.post('/api/login', creds)
      .then(({data: {token}}) => {
        // Hide the error message in case this time
        // the creds were valid.
        context.hideError();

        this.setToken(token);
        this.getUserInfo(token);

        const prevPage = localStorage.getItem('prevPage') || '/';
        router.go(prevPage);
      }, (error) => {
        // Show some error message on the invoking vm
        // telling the user that his/her credentials
        // are wrong.
        context.showError();
      });
  },

  register (userInfo) {
    Vue.http.post('/api/register', userInfo)
      .then(({data}) => {
        this.setToken(data.token);
        this.getUserInfo(data.token);
        router.go('/');
      });
  },

  getUserInfo (token) {
    token = token || localStorage.getItem('jwt-token');
    
    if (!token) {
      return false;
    }

    Vue.http.get('/api/me')
      .then(({data}) => {
        this.user.id = data.id;
        this.user.name = data.name;
        this.user.email = data.email;
        this.user.authenticated = true;
      }, ({data}) => {
        // If the token cannot be refreshed,
        // then the token is invalid.
        if (! data.refreshed_token) {
          console.error('Invalid user.');
          router.go('/');
        }
      });
  },

  checkAuth () {
    this.getUserInfo();
  },

  logout () {
    const token = this.getToken();

    if (this.user.authenticated && token) {
      this.user.authenticated = false;
      this.user.id = 0;
      this.user.name = '';
      this.user.email = '';

      localStorage.removeItem('jwt-token');
      router.go('/');
    }
  },

  getToken () {
    return localStorage.getItem('jwt-token');
  },

  setToken (token) {
    localStorage.setItem('jwt-token', token);
    return this.getUserInfo(token);
  }

}
