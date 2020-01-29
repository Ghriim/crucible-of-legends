<template>
    <div>
        <h3>Weight Tracker</h3>
        <div>
            <router-link :to="{name: 'weightTrackerAdd'}"><a>Add weight entry</a></router-link>
        </div>
        <section>
            <div v-if="[] !== weightTracker">
                <h4>Total weight</h4>
                <ul>
                    <li v-for="totalWeight in weightTracker">
                        {{ totalWeight.date }} - {{ totalWeight.value }}
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyMassIndexTracker">
                <h4>Body Mass Index (BMI)</h4>
                <ul>
                    <li v-for="bodyMassIndex in bodyMassIndexTracker" v-if="null !== bodyMassIndex.value">
                        {{ bodyMassIndex.date }} - {{ bodyMassIndex.value }}
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyFatPercentTracker">
                <h4>Body Far Percent</h4>
                <ul>
                    <li v-for="bodyFatPercent in bodyFatPercentTracker" v-if="null !== bodyFatPercent.value">
                        {{ bodyFatPercent.date }} - {{ bodyFatPercent.value }}
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>


<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'WeighTracker',
        props: {

        },
        data() {
            return {
                weightTracker: [],
                bodyMassIndexTracker: [],
                bodyFatPercentTracker: [],
                errors: []
            };
        },
        mounted() {
            apiClient.getMany('/api/statistics/weights')
                .then(response => {
                    response.data.forEach(element => {
                        this.weightTracker.push({date: element.createdDate, value: element.totalWeight});
                        this.bodyMassIndexTracker.push({date: element.createdDate, value: element.bodyMassIndex});
                        this.bodyFatPercentTracker.push({date: element.createdDate, value: element.bodyFatPercent});
                    });
                }).catch(error => {
                this.errors.push(error);
            });
        }
    };
</script>