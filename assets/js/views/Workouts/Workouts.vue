<template>
    <div>
        <div>
            <h2>Workouts</h2>
        </div>

        <div>
            <ul>
                <li v-for="workout in workouts">
                    <router-link :to="{name: 'workout', params: {workoutName: workout.name}}">
                        <a>{{ workout.name}}</a>
                    </router-link>
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