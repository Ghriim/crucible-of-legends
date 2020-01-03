<template>
    <div>
        <div>
            <h2>Agenda</h2>
        </div>

        <div v-if="agendas.length > 1">
            <ul>
                <li v-for="agenda in agendas">
                    <a href="#" @click.prevent="selectAgenda(agenda.id)">{{ agenda.name }}</a></li>
            </ul>
        </div>

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
    import apiClient from '@tools/api_client';

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
            apiClient.getOne('/api/agendas', 'default')
                .then(response => {
                    this.agenda = response.data;
                }).catch(error => {
                    this.errors.push(error);
                });

            apiClient.getMany('/api/agendas')
                .then(response => {
                    this.agendas = response.data;
                }).catch(error => {
                    this.errors.push(error);
                });
        },
        methods: {
            selectAgenda(agendaId) {
                apiClient.getOne('/api/agendas', agendaId)
                    .then(response => {
                        this.agenda = response.data;
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    };
</script>