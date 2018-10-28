<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg4>
          <v-card class="elevation-12">
            <v-toolbar dark color="success">
              <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>

            <v-card-text color="success">
              <v-form v-if="step===1">
                <v-text-field label="Email" v-model="email" :rules="[rules.required,rules.email]" required></v-text-field>
                <span class="caption grey--text text--darken-1">
                Cette email sera utilisé pour vérifier votre compte.
                </span>
              </v-form>

              <v-form v-else-if="step===2">
                <v-text-field label="Mot de passe" type="password" v-model="password" :rules="[rules.required]" required></v-text-field>
                <v-text-field label="Confirmez le mot de passe" type="password" v-model="confirmedPassword" :rules="[rules.required,rules.passwordMatch]" required></v-text-field>
                <span class="caption grey--text text--darken-1">
                Veuillez entrer un mot de passe pour votre compte
                </span>
              </v-form>

              <v-form v-else-if="step===3">
                <div class="pa-3 text-xs-center">
                  <h3 class="title font-weight-light mb-2">Bienvenue sur votre Trouvetonbar</h3>
                  <span class="caption grey--text">Merci pour votre inscription</span>
                </div>
              </v-form>
            </v-card-text>

            <v-card-actions>
              <v-btn
                :disabled="step === 1"
                flat
                @click="step--">
                Précédant
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn
                :disabled="step === 3"
                color="success"
                depressed
                @click="step++">
                Suivant
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
  name: 'TheSignUp',

  data () {
    return {
      step: 1,
      email: 'bernard@gmail.com',
      password: '',
      confirmedPassword: '',
      rules: {
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Invalid e-mail.'
        },
        passwordMatch: value => value === this.password || 'Password must match',
        required: value => !!value || 'Required.'
      }
    }
  },

  computed: {
    currentTitle () {
      switch (this.step) {
        case 1: return 'Inscription'
        case 2: return 'Mot de passe'
        case 3: return 'Inscription réussie'
      }
    }
  }
}
</script>
