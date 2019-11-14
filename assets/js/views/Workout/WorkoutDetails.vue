<template>
    <div>
        <div>
            <h2>{{ workout.name }}</h2>
        </div>

        <section>

            <div v-for="exercise in workout.exercises">
                <h3>{{ exercise.position }} - {{ exercise.name }}</h3>
                <ul>
                    <li v-for="(detail, key) in exercise.details">
                        {{ key }} {{ detail }}
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'Workout',
        props: {

        },
        data() {
            return {
                workout: null
            };
        },
        created() {
            axios.get('/api/workouts/' + this.$route.params.workoutName)
                .then(response => {
                    this.workout = response.data;
                }).catch(error => {
                    this.errors.push(error);
                })
        }
    };
</script>