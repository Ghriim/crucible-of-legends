<template>
    <div>
        <h3>Measurements</h3>
        <section>
            <div v-if="[] !== bicepsHistory">
                <h4>Biceps</h4>
                <ul>
                    <li v-for="biceps in bicepsHistory" v-if="null !== biceps.value">
                        {{ biceps.date }} - {{ biceps.value }} mm
                    </li>
                </ul>
            </div>
            <div v-if="[] !== bicepsHistory">
                <h4>Chest</h4>
                <ul>
                    <li v-for="chest in chestHistory" v-if="null !== chest.value">
                        {{ chest.date }} - {{ chest.value }} mm
                    </li>
                </ul>
            </div>
            <div v-if="[] !== waistHistory">
                <h4>Waist</h4>
                <ul>
                    <li v-for="waist in waistHistory" v-if="null !== waist.value">
                        {{ waist.date }} - {{ waist.value }} mm
                    </li>
                </ul>
            </div>
            <div v-if="[] !== thighHistory">
                <h4>Thigh</h4>
                <ul>
                    <li v-for="thigh in thighHistory" v-if="null !== thigh.value">
                        {{ thigh.date }} - {{ thigh.value }} mm
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
        name: 'MeasurementHistory',
        props: {

        },
        data() {
            return {
                bicepsHistory: [],
                chestHistory: [],
                waistHistory: [],
                thighHistory: [],
                errors: []
            };
        },
        mounted() {
            apiClient.getMany('/api/statistics/measurements')
                .then(response => {
                    response.data.forEach(element => {
                        this.bicepsHistory.push({date: element.createdDate, value: element.biceps});
                        this.chestHistory.push({date: element.createdDate, value: element.chest});
                        this.waistHistory.push({date: element.createdDate, value: element.waist});
                        this.thighHistory.push({date: element.createdDate, value: element.thigh});
                    });
                }).catch(error => {
                this.errors.push(error);
            });
        }
    };
</script>