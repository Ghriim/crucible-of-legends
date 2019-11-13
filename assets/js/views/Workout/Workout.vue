<template>
    <div>
        <div>
            <h2>{{ workout.name }}</h2>
        </div>

        <div>
            <p></p>
        </div>
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