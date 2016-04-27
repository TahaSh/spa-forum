import Vue from 'vue';
import Router from 'vue-router';
import NProgress from 'nprogress';
import auth from './services/Auth';
import Resource from 'vue-resource';
import App from './components/App.vue';
import HomeView from './components/HomeView.vue';
import LoginView from './components/LoginView.vue';
import TopicView from './components/TopicView.vue';
import {fromNow, largeNumbers} from './filters/index';
import CategoryView from './components/CategoryView.vue';
import RegisterView from './components/RegisterView.vue';

// Install some plugins
Vue.use(Router);
Vue.use(Resource);

// Register filters globally
Vue.filter('fromNow', fromNow);
Vue.filter('largeNumbers', largeNumbers);

export var router = new Router({
  history: true
});

router.map({
  '/': {
    name: 'home',
    component: HomeView
  },
  'category/:categoryId': {
    name: 'category',
    component: CategoryView
  },
  'topic/:topicId': {
    name: 'topic',
    component: TopicView
  },
  'login': {
    name: 'login',
    component: LoginView,
    guest: true
  },
  'register': {
    name: 'register',
    component: RegisterView,
    guest: true
  }
});

// Redirect 404 pages
router.redirect({
  '*': '/'
});

router.beforeEach((transition) => {
    localStorage.setItem('prevPage', transition.from.path);
    
    if (transition.to.auth && !auth.user.authenticated) {
        transition.redirect('/login');
    } else if (transition.to.guest && auth.user.authenticated) {
        transition.redirect('/');
    } else {
        transition.next();
    }
});

Vue.http.interceptors.push({

  request (request) {
    NProgress.start();

    const token = auth.getToken();
    request.headers['Authorization'] = 'Bearer ' + token;

    request.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="token"]').content;

    return request;
  },

  response (response) {
    NProgress.done();

    if (response.status == 404) {
      router.go('/');
    } else if (response.status == 401 && response.data.refreshed_token) {
      // If you received 401 "Unauthorized" response
      // with a refreshed_token in the payload,
      // this means you've got to refresh your token
      auth.setToken(response.data.refreshed_token);
    }

    return response;
  }
});

auth.checkAuth();

router.start(App, 'app');

