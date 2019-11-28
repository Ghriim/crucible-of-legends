<template>
    <div>
        <div>
            <h2>Agenda</h2>
        </div>

        <ul>
            <li v-for="agenda in agendas">
                <a href="#" @click.prevent="selectAgenda(agenda.id)">{{ agenda.name }}</a></li>
        </ul>

        <div v-if="null !== agenda">
            <div>
                <ul>
                    <li v-for="entry in agenda.entries">
                        <router-link :to="{name: 'workout', params: {canonicalName: entry.workoutCanonicalName}}">
                            {{ entry.workoutName }}</router-link>
                         {{ entry.programmedDate }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'AgendaDetails',
        props: {
        },
        data() {
            return {
                agenda: null,
                agendas: [],
                errors: []
            };
        },
        created() {
            axios.get('/api/agendas/default')
                .then(response => {
                    this.agenda = response.data;
                }).catch(error => {
                    this.errors.push(error);
                });

            axios.get('/api/agendas')
                .then(response => {
                    this.agendas = response.data;
                }).catch(error => {
                    this.errors.push(error);
                });
        },
        methods: {
            selectAgenda(agendaId) {
                axios.get('/api/agendas/' + agendaId)
                    .then(response => {
                        this.agenda = response.data;
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    };
</script>