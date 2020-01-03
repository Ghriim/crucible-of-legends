<template>
    <form @submit.prevent="handleSubmit">
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" v-model="workout.name"/>
        </div>

        <button type="submit">Create</button>
    </form>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'WorkoutCreate',
        props: {},
        data() {
            return {
                workout: {
                    name: null,
                    errors: []
                }
            }
        },
        methods: {
            handleSubmit() {
                apiClient.post('/api/workouts', this.workout)
                    .then(response => {
                        this.$router.push({ name: "workoutEdit", params: {canonicalName: response.data.canonicalName}});
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    }
</script>