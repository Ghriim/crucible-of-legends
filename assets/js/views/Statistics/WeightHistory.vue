<template>
    <div>
        <h3>Weight</h3>
        <div>
            <router-link :to="{name: 'weightHistoryCreate'}"><a>Add weight entry</a></router-link>
        </div>
        <section>
            <div v-if="[] !== weightHistory">
                <h4>Total weight</h4>
                <ul>
                    <li v-for="totalWeight in weightHistory">
                        {{ totalWeight.date }} - {{ totalWeight.value }} kg
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyMassIndexHistory">
                <h4>Body Mass Index (BMI)</h4>
                <ul>
                    <li v-for="bodyMassIndex in bodyMassIndexHistory" v-if="null !== bodyMassIndex.value">
                        {{ bodyMassIndex.date }} - {{ bodyMassIndex.value }}
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyFatPercentHistory">
                <h4>Body Far Percent</h4>
                <ul>
                    <li v-for="bodyFatPercent in bodyFatPercentHistory" v-if="null !== bodyFatPercent.value">
                        {{ bodyFatPercent.date }} - {{ bodyFatPercent.value }}%
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>


<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'WeighHistory',
        props: {

        },
        data() {
            return {
                weightHistory: [],
                bodyMassIndexHistory: [],
                bodyFatPercentHistory: [],
                errors: []
            };
        },
        mounted() {
            apiClient.getMany('/api/statistics/weights')
                .then(response => {
                    response.data.forEach(element => {
                        this.weightHistory.push({date: element.createdDate, value: element.totalWeight});
                        this.bodyMassIndexHistory.push({date: element.createdDate, value: element.bodyMassIndex});
                        this.bodyFatPercentHistory.push({date: element.createdDate, value: element.bodyFatPercent});
                    });
                }).catch(error => {
                this.errors.push(error);
            });
        }
    };
</script>