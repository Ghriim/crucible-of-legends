<template>
    <div>
        <div>
            <h2>Login</h2>
        </div>

        <form @submit.prevent="handleSubmit">
            <div>
                <label for="email">Email</label>
                <input id="email" type="text" v-model="email" required />
            </div>

            <div>
              <label for="password">Password</label>
              <input id="password" type="password" v-model="password" required />
            </div>

            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
export default {
  name: 'Login',
  props: {},
  data() {
      return {
          email: null,
          password: null
      }
  },
  methods: {
      handleSubmit() {
          this.$store.commit('loginUser');

          if (this.$route.query.redirect) {
              this.$router.push(this.$route.query.redirect);
          } else {
              this.$router.push({name: 'dashboard'});
          }
      }
  }
};
</script>