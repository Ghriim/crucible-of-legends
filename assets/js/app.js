import Vue from "vue"
import App from "./App";
import router from "@tools/router";
import store from "@tools/store";


new Vue({
  components: { App },
  template: "<App/>",
  store,
  router
}).$mount("#app");