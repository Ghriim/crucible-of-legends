import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLogged: null !== localStorage.getItem('authToken')
    },
    mutations: {
        loginUser(state) {
            localStorage.setItem('authToken', 'auth_token');
            state.isLogged = true;
        },
        logoutUser(state) {
            localStorage.removeItem('authToken');
            state.isLogged = false;
        }
    }
});

export default store;