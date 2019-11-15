<template>
    <div v-if="null !== workout">
        <div>
            <h2>Edit: {{ workout.name }}</h2>
        </div>

        <section>

            <div v-for="(exercise, index) in workout.exercises">
                <h3>{{ exercise.position }} - {{ exercise.name }}</h3>
                <button v-on:click="handleDelete(exercise.id, index)">Delete</button>
                <ul>
                    <li v-for="(detail, key) in exercise.details">
                        {{ key }} {{ detail }}
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div  v-else>
        <p v-for="error in errors">{{ error }}</p>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'WorkoutEdit',
        props: {

        },
        data() {
            return {
                workout: null,
                errors: []
            };
        },
        mounted() {
            this.getWorkout(this.$route.params.canonicalName);

        },
        methods: {
            handleDelete(exerciseId, index) {
                this.workout.exercises.splice(index, 1);
                axios.delete('/api/workouts/' + this.workout.canonicalName + '/exercises/' + exerciseId)
                    .then(response => {
                        this.getWorkout(this.workout.canonicalName);
                    }).catch(error => {
                        this.errors.push('An error has occurred, please try again later.')
                    })
            },
            getWorkout(canonicalName) {
                axios.get('/api/workouts/' + canonicalName)
                    .then(response => {
                        this.workout = response.data;
                    }).catch(error => {
                    if (404 === error.response.status) {
                        this.errors.push('No matching workout found');
                    } else {
                        this.errors.push('An error has occurred, please try again later.')
                    }
                })
            }
        }
    };
</script>