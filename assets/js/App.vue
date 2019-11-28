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
          <div class="top-bar-left">
            <ul class="menu">
              <router-link :to="{name: 'home'}">
                <a>Home</a>
              </router-link>

              <router-link :to="{name: 'dashboard'}">
                <a>Dashboard</a>
              </router-link>
              <router-link :to="{name: 'workouts'}">
                <a>Agenda</a>
              </router-link>
              <router-link :to="{name: 'workouts'}">
                <a>Workouts</a>
              </router-link>
            </ul>
          </div>

          <div class="top-bar-right">
            <ul class="menu">
              <router-link :to="{name: 'registration'}">
                <a>Registration</a>
              </router-link>
              <router-link :to="{name: 'login'}">
                <a>Login</a>
              </router-link>
              <router-link :to="{name: 'logout'}">
                <a>Logout</a>
              </router-link>
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
}
</script>