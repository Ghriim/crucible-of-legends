import Vue from "vue";
import Vuex from "vuex";
import router from "@tools/router";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLogged: null !== localStorage.getItem('authToken'),
        token: localStorage.getItem('authToken')
    },
    mutations: {
        loginUser(state) {
            localStorage.setItem('authToken', state.token);
            state.isLogged = true;
        },
        logoutUser(state) {
            localStorage.removeItem('authToken');
            state.isLogged = false;

            router.push({name: 'login'});
        }
    }
});

export default store;