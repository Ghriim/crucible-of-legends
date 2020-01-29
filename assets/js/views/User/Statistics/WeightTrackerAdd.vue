<template>
    <form @submit.prevent="handleSubmit">
        <div>
            <label for="totalWeight">Weight (in kg)</label>
            <input id="totalWeight" type="text" v-model="weight.totalWeight" required/>
        </div>

        <div>
            <label for="bodyMassIndex">Body Mass Index</label>
            <input id="bodyMassIndex" type="text" v-model="weight.bodyMassIndex"/>
        </div>

        <div>
            <label for="bodyFatPercent">Body Fat Percent (in %)</label>
            <input id="bodyFatPercent" type="text" v-model="weight.bodyFatPercent"/>
        </div>

        <button type="submit">Create</button>
    </form>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'WeighTrackerAdd',
        data() {
            return {
                weight: {
                    totalWeight: null,
                    bodyMassIndex: null,
                    bodyFatPercent: null
                },
                errors: []
            }
        },
        methods: {
            handleSubmit() {
                apiClient.post('/api/statistics/weights', this.weight)
                    .then(response => {
                        this.$router.push({ name: "weightTracker"});
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    }
</script>