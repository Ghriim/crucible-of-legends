<template>
        <md-app>
            <md-app-toolbar class="md-primary" md-elevation="0">
                <div class="md-toolbar-section-end">
                    <router-link :to="{name: 'logout'}" class="md-icon-button" title="Notifications"><md-icon>notifications</md-icon></router-link>
                    <router-link :to="{name: 'logout'}" class="md-icon-button" title="Settings"><md-icon>settings</md-icon></router-link>
                    <router-link :to="{name: 'logout'}" class="md-icon-button" title="Logout"><md-icon>lock_open</md-icon></router-link>
                </div>
            </md-app-toolbar>

            <md-app-drawer md-permanent="full">
                <md-toolbar class="md-primary" md-elevation="0">
                    Crucible of Legends
                </md-toolbar>

                <md-list>
                    <md-list-item>
                        <router-link :to="{name: 'dashboard'}">
                            <md-icon>home</md-icon>
                            Dashboard
                        </router-link>
                    </md-list-item>
                    <md-list-item>
                        <router-link :to="{name: 'agenda'}">
                            <md-icon>calendar_today</md-icon>
                            Agenda
                        </router-link>
                    </md-list-item>
                    <md-list-item>
                        <router-link :to="{name: 'workouts'}">
                            <md-icon>fitness_center</md-icon>
                            Workouts
                        </router-link>
                    </md-list-item>
                    <md-list-item md-expand>
                        <router-link :to="{name: 'workouts'}">
                            <md-icon>public</md-icon>
                            Community
                        </router-link>
                        <md-list slot="md-expand">
                            <md-list-item class="md-inset">
                                <router-link :to="{name: 'workouts'}">
                                    <md-icon>people</md-icon>
                                    Friends
                                </router-link>
                            </md-list-item>
                            <md-list-item class="md-inset">
                                <router-link :to="{name: 'workouts'}">
                                    <md-icon>emoji_events</md-icon>
                                    Leaders board
                                </router-link>
                            </md-list-item>
                        </md-list>
                    </md-list-item>
                    <md-list-item md-expand>
                        <router-link :to="{name: 'statistics'}">
                            <md-icon>pie_chart</md-icon>
                            Statistics
                        </router-link>
                        <md-list slot="md-expand">
                            <md-list-item class="md-inset">
                                <router-link :to="{name: 'weightTracker'}">
                                    <md-icon>face</md-icon>
                                    Weight Tracker
                                </router-link>
                            </md-list-item>
                            <md-list-item class="md-inset">
                                <router-link :to="{name: 'measurementTracker'}">
                                    <md-icon>accessibility_new</md-icon>
                                    Measurement Tracker
                                </router-link>
                            </md-list-item>
                            <md-list-item class="md-inset">
                                <router-link :to="{name: 'measurementTracker'}">
                                    <md-icon>local_drink</md-icon>Watter Tracker
                                </router-link>
                            </md-list-item>
                        </md-list>
                    </md-list-item>
                </md-list>
            </md-app-drawer>

            <md-app-content>
                <transition name="fade" mode="out-in">
                    <router-view />
                </transition>
            </md-app-content>
        </md-app>
</template>

<script>
    export default {
        name: "UserApp",
    }
</script>
