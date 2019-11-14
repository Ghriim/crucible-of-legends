<template>
    <div>
        <div>
            <h2>Workouts</h2>
            <router-link :to="{name: 'workoutCreate'}">
                <a>Add workout</a>
            </router-link>
        </div>

        <div v-if="[] !== workouts">
            <ul>
                <li v-for="workout in workouts">
                    <router-link :to="{name: 'workout', params: {canonicalName: workout.canonicalName}}">
                        <a>{{ workout.name}}</a>
                    </router-link>
                    - <em>{{ workout.createdDate }}</em>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'Workouts',
        props: {
        },
        data() {
            return {
                workouts: [],
                errors: []
            };
        },
        created() {
            axios.get('/api/workouts')
                .then(response => {
                    this.workouts = response.data;
                }).catch(error => {
                    this.errors.push(error);
                })
        }
    };
</script>