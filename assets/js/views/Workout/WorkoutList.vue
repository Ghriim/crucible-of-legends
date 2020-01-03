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
                <li v-for="(workout, index) in workouts">
                    <router-link :to="{name: 'workout', params: {canonicalName: workout.canonicalName}}">
                        <a>{{ workout.name}}</a>
                    </router-link>
                    - <em>{{ workout.createdDate }}</em>

                    <router-link :to="{name: 'workoutEdit', params: {canonicalName: workout.canonicalName}}">
                        <a>Edit</a>
                    </router-link>

                    <button v-on:click="handleDelete(workout.canonicalName, index)">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

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
            apiClient.getMany('/api/workouts')
                .then(response => {
                    this.workouts = response.data;
                }).catch(error => {
                    this.errors.push(error);
                })
        },
        methods: {
            handleDelete(canonicalName, index) {
                this.workouts.splice(index, 1);
                apiClient.deleteOne('/api/workouts', canonicalName)
                    .then(response => {
                    }).catch(error => {
                        this.errors.push('An error has occurred, please try again later.')
                    })
            },
        }
    };
</script>