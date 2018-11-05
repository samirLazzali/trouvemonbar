<template>
  <v-content>
    <v-snackbar
      v-model="snackbar"
      bottom
      left
      color="error"
      :timeout="3000"
    >
      Login ou Mot de passe incorrect
    </v-snackbar>

    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg4>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
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
                  :rules="rules"
                  @keyup.enter="submit"
                ></v-text-field>

                <v-text-field
                  v-model="password"
                  id="password"
                  prepend-icon="lock"
                  name="password"
                  label="Mot de passe"
                  type="password"
                  :rules="rules"
                  @keyup.enter="submit"
                ></v-text-field>
              </v-form>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
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
      rules: [
        value => value.length >= 3 || 'Min 3 caractères.',
        value => value.length < 25 || 'Max 25 caractères.',
        value => !!value || 'Obligatoire.'
      ],
      snackbar: false
    }
  },

  methods: {
    async submit () {
      if (!this.$refs.login.validate()) return

      try {
        await this.$store.dispatch('login', {
          login: this.login,
          password: this.password
        })
        this.$router.push('/')
      } catch (err) {
        this.$log.error(err)
        this.snackbar = true
      }
    }
  }
}
</script>
