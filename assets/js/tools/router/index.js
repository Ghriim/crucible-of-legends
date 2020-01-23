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
import WeightTracker from "@views/Statistics/WeightTracker";
import WeightTrackerAdd from "@views/Statistics/WeightTrackerAdd";
import MeasurementTracker from "@views/Statistics/MeasurementTracker";
import MeasurementTrackerAdd from "@views/Statistics/MeasurementTrackerAdd";

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
        { name: "weightTracker", path: "/statistics/weights", component: WeightTracker, beforeEnter: requireAuth },
        { name: "weightTrackerAdd", path: "/statistics/weights/add", component: WeightTrackerAdd, beforeEnter: requireAuth },
        { name: "measurementTracker", path: "/statistics/measurements", component: MeasurementTracker, beforeEnter: requireAuth },
        { name: "measurementTrackerAdd", path: "/statistics/measurements/add", component: MeasurementTrackerAdd, beforeEnter: requireAuth },

        { path: "*", redirect: "/" }
    ]
});