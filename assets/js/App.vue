<template>
  <div class="page-container">
    <section v-if="true === this.$store.state.isLogged">
      <UserApp />
    </section>

    <section v-if="false === this.$store.state.isLogged">
      <PublicApp />
    </section>
  </div>
</template>

<script>
import UserApp from "@user-views/UserApp";
import PublicApp from "@public-views/PublicApp";


export default {
    name: "App",
    components: {PublicApp, UserApp},
}
</script>
