<template>
    <div>
        <div>
            <h2>Statistics Overview</h2>
        </div>
        <h3>Weight</h3>
        <section>
            <div v-if="[] !== weightHistory">
                <h4>Total weight</h4>
                <ul>
                    <li v-for="totalWeight in weightHistory">
                        {{ totalWeight }} Kg
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyMassIndexHistory">
                <h4>Body Mass Index (BMI)</h4>
                <ul>
                    <li v-for="bodyMassIndex in bodyMassIndexHistory" v-if="null !== bodyMassIndex">
                        {{ bodyMassIndex }}
                    </li>
                </ul>
            </div>

            <div v-if="[] !== bodyFatPercentHistory">
                <h4>Body Far Percent</h4>
                <ul>
                    <li v-for="bodyFatPercent in bodyFatPercentHistory" v-if="null !== bodyFatPercent">
                        {{ bodyFatPercent }}%
                    </li>
                </ul>
            </div>
        </section>

        <h3>Measurements</h3>
        <section>
            <div v-if="[] !== bicepsHistory">
                <h4>Biceps (in mm)</h4>
                <ul>
                    <li v-for="biceps in bicepsHistory" v-if="null !== biceps">
                        {{ biceps }}%
                    </li>
                </ul>
            </div>
            <div v-if="[] !== bicepsHistory">
                <h4>Chest (in mm)</h4>
                <ul>
                    <li v-for="chest in chestHistory" v-if="null !== chest">
                        {{ chest }}%
                    </li>
                </ul>
            </div>
            <div v-if="[] !== waistHistory">
                <h4>Waist (in mm)</h4>
                <ul>
                    <li v-for="waist in waistHistory" v-if="null !== waist">
                        {{ waist }}%
                    </li>
                </ul>
            </div>
            <div v-if="[] !== thighHistory">
                <h4>Thigh (in mm)</h4>
                <ul>
                    <li v-for="thigh in thighHistory" v-if="null !== thigh">
                        {{ thigh }}%
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'StatisticsOverview',
        props: {

        },
        data() {
            return {
                weightHistory: [],
                bodyMassIndexHistory: [],
                bodyFatPercentHistory: [],
                bicepsHistory: [],
                chestHistory: [],
                waistHistory: [],
                thighHistory: [],
                errors: []
            };
        },
        mounted() {
            apiClient.getMany('/api/statistics/weights')
                .then(response => {
                    response.data.forEach(element => {
                        this.weightHistory.push(element.totalWeight);
                        this.bodyMassIndexHistory.push(element.bodyMassIndex);
                        this.bodyFatPercentHistory.push(element.bodyFatPercent);
                    });
                }).catch(error => {
                this.errors.push(error);
            });

            apiClient.getMany('/api/statistics/measurements')
                .then(response => {
                    response.data.forEach(element => {
                        this.bicepsHistory.push(element.biceps);
                        this.chestHistory.push(element.chest);
                        this.waistHistory.push(element.waist);
                        this.thighHistory.push(element.thigh);
                    });
                }).catch(error => {
                this.errors.push(error);
            });
        }
    };
</script>