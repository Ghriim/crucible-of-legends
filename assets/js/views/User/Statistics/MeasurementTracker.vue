<template>
    <div>
        <h3>Measurements Tracker</h3>
        <div>
            <router-link :to="{name: 'measurementTrackerAdd'}"><a>Add measurements entry</a></router-link>
        </div>
        <section>
            <div v-if="[] !== bicepsTracker">
                <h4>Biceps</h4>
                <ul>
                    <li v-for="biceps in bicepsTracker" v-if="null !== biceps.value">
                        {{ biceps.date }} - {{ biceps.value }}
                    </li>
                </ul>
            </div>
            <div v-if="[] !== bicepsTracker">
                <h4>Chest</h4>
                <ul>
                    <li v-for="chest in chestTracker" v-if="null !== chest.value">
                        {{ chest.date }} - {{ chest.value }}
                    </li>
                </ul>
            </div>
            <div v-if="[] !== waistTracker">
                <h4>Waist</h4>
                <ul>
                    <li v-for="waist in waistTracker" v-if="null !== waist.value">
                        {{ waist.date }} - {{ waist.value }}
                    </li>
                </ul>
            </div>
            <div v-if="[] !== thighTracker">
                <h4>Thigh</h4>
                <ul>
                    <li v-for="thigh in thighTracker" v-if="null !== thigh.value">
                        {{ thigh.date }} - {{ thigh.value }}
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'MeasurementTracker',
        props: {

        },
        data() {
            return {
                bicepsTracker: [],
                chestTracker: [],
                waistTracker: [],
                thighTracker: [],
                errors: []
            };
        },
        mounted() {
            apiClient.getMany('/api/statistics/measurements')
                .then(response => {
                    response.data.forEach(element => {
                        this.bicepsTracker.push({date: element.createdDate, value: element.biceps});
                        this.chestTracker.push({date: element.createdDate, value: element.chest});
                        this.waistTracker.push({date: element.createdDate, value: element.waist});
                        this.thighTracker.push({date: element.createdDate, value: element.thigh});
                    });
                }).catch(error => {
                this.errors.push(error);
            });
        }
    };
</script>