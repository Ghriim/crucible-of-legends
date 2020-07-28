<template>
    <div>
        <div>
            <h2>Workouts</h2>
            <router-link :to="{name: 'workoutCreate'}">
                <a>Add workout</a>
            </router-link>
        </div>

        <div v-if="[] !== workouts">
            <md-card md-with-hover v-for="(workout, index) in workouts">
                <md-card-header>
                    <div class="md-title">
                        <router-link :to="{name: 'workout', params: {canonicalName: workout.canonicalName}}">
                            <a>{{ workout.name}}</a>
                        </router-link>
                    </div>
                    <div class="md-subhead">
                        Created: <em>{{ workout.createdDate }}</em>
                    </div>
                </md-card-header>

                <md-card-actions>
                    <md-button class="md-primary">
                        <router-link :to="{name: 'workoutEdit', params: {canonicalName: workout.canonicalName}}">
                            Edit
                        </router-link>
                    </md-button>

                    <md-button class="md-accent" v-on:click="handleDelete(workout.canonicalName, index)">Delete</md-button>
                </md-card-actions>
            </md-card>
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
        mounted() {
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