// const { h } = require('vue');

window.Vue = require('vue');
window.axios = require('axios');


//importo il router
import router from './router';


// import VueRouter from 'vue-router'

// import Home from "./pages/Home.vue";

// Vue.use(VueRouter)


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import App from "./views/App.vue";




// //history ha url standard
// const router = new VueRouter({
//   mode: 'history',
//   //gli passo le rotte
//   routes: routes,
// })

const app = new Vue({
  el: '#app',
  render: h => h(App),
  router: router
});
