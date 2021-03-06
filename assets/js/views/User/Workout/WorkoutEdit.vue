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

        <section>
            <h3>Add an exercise</h3>

            <form @submit.prevent="handleSubmit">
                <div v-if="[] !== formErrors">
                    <p v-for="formError in formErrors">{{ formError }}</p>
                </div>
                <div>
                    <label for="referenceExercise">Reference Exercise</label>
                    <select id="referenceExercise" v-model="exercise.referenceExerciseId" required>
                        <option v-for="referenceExercise in referenceExercises" :value="referenceExercise.id">
                            {{ referenceExercise.name }}
                        </option>
                    </select>
                </div>

                <div>
                    <label for="durationProgrammed">Duration</label>
                    <input type="number"  min="0" id="durationProgrammed" v-model="exercise.durationProgrammed" />
                </div>


                <div>
                    <label for="repetitionsProgrammed">Repetitions</label>
                    <input type="number" min="0" id="repetitionsProgrammed" v-model="exercise.repetitionsProgrammed" />
                </div>

                <div>
                    <label for="weightProgrammed">Weight</label>
                    <input type="number" min="0" step="0.05" id="weightProgrammed" v-model="exercise.weightProgrammed" />
                </div>

                <button type="submit">Add</button>
            </form>
        </section>
    </div>
    <div  v-else>
        <p v-for="error in errors">{{ error }}</p>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'WorkoutEdit',
        props: {

        },
        data() {
            return {
                workout: null,
                exercise: null,
                referenceExercises: [],
                formErrors: [],
                errors: []
            };
        },
        mounted() {
            this.initExercise();
            this.getWorkout(this.$route.params.canonicalName);
            this.getReferenceExercises('');

        },
        methods: {
            handleDelete(exerciseId, index) {
                this.workout.exercises.splice(index, 1);
                apiClient.deleteOne('/api/workouts/' + this.workout.canonicalName + '/exercises/', exerciseId)
                    .then(response => {
                        this.getWorkout(this.workout.canonicalName);
                    }).catch(error => {
                        this.errors.push('An error has occurred, please try again later.')
                    })
            },
            getWorkout(canonicalName) {
                apiClient.getOne('/api/workouts', canonicalName)
                    .then(response => {
                        this.workout = response.data;
                    }).catch(error => {
                        if (404 === error.response.status) {
                            this.errors.push('No matching workout found');
                        } else {
                            this.errors.push('An error has occurred, please try again later.')
                        }
                    })
            },
            getReferenceExercises(nameLike) {
                apiClient.getMany('/api/references/exercises', {'nameLike': nameLike})
                    .then(response => {
                        this.referenceExercises = response.data;
                    }).catch(error => {
                        this.errors.push('An error has occurred, please try again later.')
                    })
            },
            handleSubmit() {
                this.exercise.workoutCanonicalName = this.workout.canonicalName;

                apiClient.post('/api/workouts/' + this.workout.canonicalName + '/exercises', this.exercise)
                    .then(response => {
                        this.getWorkout(this.workout.canonicalName);
                        this.initExercise();
                    }).catch(error => {
                        this.formErrors.push('An error has occurred, please try again later.')
                    })
            },
            initExercise() {
                this.exercise = {
                    workoutCanonicalName: null,
                        referenceExerciseId: null,
                        durationProgrammed: null,
                        repetitionsProgrammed: null,
                        weightProgrammed: null

                };
            }
        }
    };
</script>