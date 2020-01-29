import Vue from "vue"
import App from "./App";
import router from "@tools/router";
import store from "@tools/store";

import VueMaterial from 'vue-material';

Vue.use(VueMaterial);

new Vue({
  components: { App },
  template: "<App/>",
  store,
  router
}).$mount("#app");