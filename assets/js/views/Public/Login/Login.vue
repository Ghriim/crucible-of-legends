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

            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
    import apiClient from '@tools/api_client';
    import store from "@tools/store";
    import router from "@tools/router";

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
                apiClient.post('/api/login_check', this.login)
                    .then(response => {
                        store.state.token = response.data.token;
                        store.commit('loginUser');

                        if (this.$route.query.redirect) {
                            router.push(this.$route.query.redirect);
                        } else {
                            router.push({name: 'dashboard'});
                        }
                    }).catch(error => {
                        this.errors.push(error);
                    });
            }
        }
    };
</script>