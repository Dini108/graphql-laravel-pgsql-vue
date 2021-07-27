import Vue from 'vue';
import VueRouter from 'vue-router';
import UserList from '../components/UserList.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: UserList,
    name: 'user.index'
  },
  {
    path: '*',
    redirect: '/'
  }
];

export default new VueRouter({
  routes,
  mode: 'history',
  linkActiveClass: 'active',
});;