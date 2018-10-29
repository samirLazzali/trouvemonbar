<template>
  <div>
    <v-snackbar
      v-model="snackbar"
      bottom
      left
      :color="snackbarState"
      :timeout="3000"
    >
      {{ snackbarText }}
    </v-snackbar>

    <v-card flat>
      <v-card-text>
        <v-container>
          <v-form v-model="isValid" ref="user" lazy-validation>
            <v-text-field
              label="Email"
              :value="user.email"
              disabled
            ></v-text-field>

            <v-text-field
              label="Pseudo"
              :value="user.pseudo"
              disabled
            ></v-text-field>

            <v-text-field
              v-model="password"
              type="password"
              label="Modifier mon mot de passe"
              :rules="rules"
            ></v-text-field>

            <v-text-field
              v-model="confirmedPassword"
              type="password"
              label="Confirmer mon mot de passe"
              :rules="rules"
            ></v-text-field>

            <v-btn color="success"
              @click="submit"
              :disabled="!isValid"
            >
            Modifier
            </v-btn>
          </v-form>
        </v-container>
      </v-card-text>
    </v-card>
    </div>
</template>

<script>
export default {
  name: 'TheAccount',

  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      snackbar: false,
      snackbarText: '',
      snackbarState: 'error',
      isValid: false,
      rules: [
        value => value.length >= 3 || 'Min 3 caractères.',
        value => value.length < 25 || 'Max 25 caractères.',
        value => value === this.password || 'Password must match',
        value => !!value || 'Required.'
      ],
      password: '',
      confirmedPassword: ''
    }
  },
  methods: {
    async submit () {
      if (!this.$refs.user.validate()) return
      try {
        // Add the password to the user Object
        this.user.password = this.password
        await this.$api.updateUser(this.user)
        this.snackbarText = 'Mise à jour du mot de passe réussie.'
        this.snackbarState = 'success'
        this.snackbar = true
        setTimeout(() => this.$router.push('/me'), 2000)
      } catch (err) {
        this.$log.error(err)
        switch (err.response.status) {
          case 400:
            this.snackbarText = 'Paramètres invalides.'
            this.snackbarState = 'error'
            break
          case 401:
            this.snackbarText = 'Opération non autorisé'
            this.snackbarState = 'error'
            break
          case 500:
            this.snackbarText = 'Erreur interne.'
            this.snackbarState = 'error'
            break
          default:
            this.snackbarText = 'Une erreur s\'est produite'
            this.snackbarState = 'error'
            break
        }
        this.snackbar = true
      }
    }
  }
}
</script>
