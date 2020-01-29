<template>
    <form @submit.prevent="handleSubmit">
        <div>
            <label for="biceps">Biceps (in cm)</label>
            <input id="biceps" type="text" v-model="measurement.biceps"/>
        </div>
        <div>
            <label for="chest">Chest (in cm)</label>
            <input id="chest" type="text" v-model="measurement.chest"/>
        </div>

        <div>
            <label for="waist">Waist (in cm)</label>
            <input id="waist" type="text" v-model="measurement.waist"/>
        </div>

        <div>
            <label for="thigh">Thigh (in cm)</label>
            <input id="thigh" type="text" v-model="measurement.thigh"/>
        </div>

        <button type="submit">Create</button>
    </form>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'MeasurementTrackerCreate',
        data() {
            return {
                measurement: {
                    biceps: null,
                    chest: null,
                    waist: null,
                    thigh: null
                },
                errors: []
            }
        },
        methods: {
            handleSubmit() {
                apiClient.post('/api/statistics/measurements', this.measurement)
                    .then(response => {
                        this.$router.push({ name: "measurementTracker"});
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    }
</script>