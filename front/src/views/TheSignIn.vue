<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md6 lg4>
            <v-card class="elevation-12">
              <v-toolbar dark color="success">
                <v-toolbar-title>Formulaire de connexion</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>

              <v-card-text>
                <v-form v-model="isValid" ref="login" lazy-validation>
                  <v-text-field
                    v-model="login"
                    prepend-icon="person"
                    name="login"
                    label="Login"
                    type="text"
                    :rules="[rules.required,rules.email]"
                  ></v-text-field>
                  <v-text-field
                    v-model="password"
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Mot de passe"
                    type="password"
                    :rules="[rules.required,rules.minCounter,rules.maxCounter]"
                  ></v-text-field>
                </v-form>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="success"
                  @click="submit"
                  :disabled="!isValid"
                >
                  Connexion
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'TheSignIn',

  props: {
    source: String
  },

  data () {
    return {
      drawer: null,
      isValid: false,
      login: '',
      password: '',
      rules: {
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Invalid e-mail.'
        },
        minCounter: value => value.length >= 3 || 'Min 3 characters',
        maxCounter: value => value.length < 25 || 'Max 25 characters',
        required: value => !!value || 'Required.'
      }
    }
  },

  methods: {
    async submit () {
      if (!this.$refs.login.validate()) return

      try {
        const res = await this.$api.login({
          email: this.login,
          password: this.password
        })
        localStorage.setItem('user-token', res.headers.authorization)

        this.$log.debug('logged', res.data)
        this.$store.commit('user', res.data)
        this.$router.push('/')
      } catch (error) {
        localStorage.removeItem('user-toker')
        this.$log.error('An error occured during the login')
        this.$log.debug(error)
      }
    }
  }
}
</script>
