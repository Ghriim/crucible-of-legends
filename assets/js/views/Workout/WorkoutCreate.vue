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
    import axios from 'axios';

    export default {
        name: 'WorkoutCreate',
        props: {},
        data() {
            return {
                workout: {
                    name: null
                }
            }
        },
        methods: {
            handleSubmit() {
                axios.post('/api/workouts', this.workout)
                    .then(response => {
                        console.log(response.data);
                    }).catch(error => {
                        this.errors.push(error);
                    })
            }
        }
    }
</script>