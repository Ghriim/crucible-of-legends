import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home/Home";
import Login from "../views/Login/Login";
import Registration from "../views/Registration/Registration";
import Dashboard from "../views/Dashboard/Dashboard";
import WorkoutDetails from "../views/Workout/WorkoutDetails";
import WorkoutCreate from "../views/Workout/WorkoutCreate";
import WorkoutEdit from "../views/Workout/WorkoutEdit";
import WorkoutList from "../views/Workout/WorkoutList";

Vue.use(VueRouter);

function requireAuth (to, from, next) {
    if (null === localStorage.getItem('authToken')) {
        next({
            name: 'login',
            query: { redirect: to.fullPath }
        })
    } else {
        next()
    }
}

function logout(to, from, next) {
    localStorage.removeItem('authToken');
    next({
        name: 'home'
    });
}

export default new VueRouter({
    mode: "history",
    routes: [
        { name: "home", path: "/", component: Home },
        { name: "registration", path: "/registration", component: Registration },
        { name: "login", path: "/login", component: Login },
        { name: "logout", path: "/logout", beforeEnter: logout },
        { name: "dashboard", path: "/dashboard", component: Dashboard, beforeEnter: requireAuth },
        { name: "workouts", path: "/workouts", component: WorkoutList/*, beforeEnter: requireAuth */},
        { name: "workoutCreate", path: "/workouts/create", component: WorkoutCreate /*, beforeEnter: requireAuth */},
        { name: "workout", path: "/workouts/:canonicalName", component: WorkoutDetails/*, beforeEnter: requireAuth */, props: true},
        { name: "workoutEdit", path: "/workouts/:canonicalName/edit", component: WorkoutEdit/*, beforeEnter: requireAuth */, props: true},

        { path: "*", redirect: "/" }
    ]
});