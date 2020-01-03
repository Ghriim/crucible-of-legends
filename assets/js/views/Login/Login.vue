<template>
    <div>
        <div>
            <h2>Login</h2>
        </div>

        <form @submit.prevent="handleSubmit">
            <div>
                <label for="email">Email</label>
                <input id="email" type="text" v-model="login.email" required />
            </div>

            <div>
              <label for="password">Password</label>
              <input id="password" type="password" v-model="login.password" required />
            </div>

            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';

    export default {
      name: 'Login',
      props: {},
      data() {
          return {
              login: {
                  email: null,
                  password: null
              },
              errors: []
          }
      },
      methods: {
          handleSubmit() {
              this.$store.commit('loginUser');
              apiClient.post('/api/login_check', this.login)
                  .then(response => {
                  }).catch(error => {
                      this.errors.push(error);
                  });

              /*
              if (this.$route.query.redirect) {
                  this.$router.push(this.$route.query.redirect);
              } else {
                  this.$router.push({name: 'dashboard'});
              }*/
          }
      }
    };
</script>