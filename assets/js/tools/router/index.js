import Vue from "vue";
import VueRouter from "vue-router";
import store from "@tools/store";
import Home from "@views/Home/Home";
import Login from "@views/Login/Login";
import Registration from "@views/Registration/Registration";
import Dashboard from "@views/Dashboard/Dashboard";
import WorkoutDetails from "@views/Workout/WorkoutDetails";
import WorkoutCreate from "@views/Workout/WorkoutCreate";
import WorkoutEdit from "@views/Workout/WorkoutEdit";
import WorkoutList from "@views/Workout/WorkoutList";
import AgendaDetails from "@views/Agenda/AgendaDetails";
import StatisticsOverview from "@views/Statistics/StatisticsOverview";
import WeightHistory from "@views/Statistics/WeightHistory";
import WeightHistoryCreate from "@views/Statistics/WeightHistoryCreate";
import MeasurementHistory from "@views/Statistics/MeasurementHistory";
import MeasurementHistoryCreate from "@views/Statistics/MeasurementHistoryCreate";

Vue.use(VueRouter);

function requireAuth (to, from, next) {
    if (false === store.state.isLogged) {
        next({
            name: 'login',
            query: { redirect: to.fullPath }
        })
    } else {
        next()
    }
}

function isAlreadyLogged(to, from, next) {
    if (true === store.state.isLogged) {
        next({
            name: 'home'
        });
    } else {
        next()
    }
}

function logout(to, from, next) {
    store.commit('logoutUser');

    next({
        name: 'home'
    });
}

export default new VueRouter({
    mode: "history",
    routes: [
        { name: "home", path: "/", component: Home },
        { name: "registration", path: "/registration", component: Registration, beforeEnter: isAlreadyLogged },
        { name: "login", path: "/login", component: Login, beforeEnter: isAlreadyLogged },
        { name: "logout", path: "/logout", beforeEnter: logout },
        { name: "dashboard", path: "/dashboard", component: Dashboard, beforeEnter: requireAuth },
        { name: "workouts", path: "/workouts", component: WorkoutList, beforeEnter: requireAuth },
        { name: "workoutCreate", path: "/workouts/create", component: WorkoutCreate, beforeEnter: requireAuth },
        { name: "workout", path: "/workouts/:canonicalName", component: WorkoutDetails, beforeEnter: requireAuth , props: true},
        { name: "workoutEdit", path: "/workouts/:canonicalName/edit", component: WorkoutEdit, beforeEnter: requireAuth , props: true},
        { name: "agenda", path: "/agenda", component: AgendaDetails, beforeEnter: requireAuth },
        { name: "statistics", path: "/statistics", component: StatisticsOverview, beforeEnter: requireAuth },
        { name: "weightHistory", path: "/statistics/weights", component: WeightHistory, beforeEnter: requireAuth },
        { name: "weightHistoryCreate", path: "/statistics/weights/add", component: WeightHistoryCreate, beforeEnter: requireAuth },
        { name: "measurementHistory", path: "/statistics/measurements", component: MeasurementHistory, beforeEnter: requireAuth },
        { name: "measurementHistoryCreate", path: "/statistics/measurements/add", component: MeasurementHistoryCreate, beforeEnter: requireAuth },

        { path: "*", redirect: "/" }
    ]
});