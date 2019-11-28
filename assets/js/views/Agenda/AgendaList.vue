<template>
    <div>
        <div>
            <h2>Agenda</h2>
        </div>

        <div v-if="[] !== agendas">
            <div v-for="agenda in agendas">
                <h4>{{ agenda.name }}</h4>
                <div>
                    <ul>
                        <li v-for="entry in agenda.entries">{{ entry.workoutName }} {{ entry.programmedDate }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'AgendaList',
        props: {
        },
        data() {
            return {
                agendas: [],
                errors: []
            };
        },
        created() {
            axios.get('/api/agendas')
                .then(response => {
                    this.agendas = response.data;
                }).catch(error => {
                this.errors.push(error);
            })
        }
    };
</script>