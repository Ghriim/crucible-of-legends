<template>
  <div>
    <header>
      <h1>
        <router-link :to="{name: 'home'}">
          <a>Crucible of Heroes</a>
        </router-link>
      </h1>
      <nav>
        <div class="top-bar">
          <div v-if="true === this.$store.state.isLogged" class="top-bar-left">
            <ul class="menu">
              <li>
                  <router-link :to="{name: 'dashboard'}"><a>Dashboard</a></router-link>
              </li>
              <li>
                  <router-link :to="{name: 'agenda'}"><a>Agenda</a></router-link>
              </li>
              <li>
                  <router-link :to="{name: 'workouts'}"><a>Workouts</a></router-link>
              </li>
            </ul>
          </div>

          <div class="top-bar-right">
            <ul class="menu">
              <li v-if="false === this.$store.state.isLogged">
                <router-link :to="{name: 'registration'}"><a>Registration</a></router-link>
              </li>
              <li v-if="false === this.$store.state.isLogged">
                  <router-link :to="{name: 'login'}"><a>Login</a></router-link>
              </li>
              <li v-if="true === this.$store.state.isLogged">
                  <router-link :to="{name: 'logout'}"><a>Logout</a></router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <article class="grid-container">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </article>
  </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLogged: false
        }
    },
    updated() {
    },
}
</script>