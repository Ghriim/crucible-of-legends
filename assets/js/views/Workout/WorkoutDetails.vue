<template>
    <div v-if="null !== workout">
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
    <div  v-else>
        <p v-for="error in errors">{{ error }}</p>
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
                workout: null,
                errors: []
            };
        },
        mounted() {
            axios.get('/api/workouts/' + this.$route.params.canonicalName)
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
    };
</script>