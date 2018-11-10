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
              v-model="currentPassword"
              type="password"
              label="Mot de passe actuel"
              :rules="passwordRules"
              @keyup.enter="submit"
            ></v-text-field>

            <v-text-field
              v-model="password"
              type="password"
              label="Modifier mon mot de passe"
              :rules="passwordRules,differentPasswordRules"
              @keyup.enter="submit"
            ></v-text-field>

            <v-text-field
              v-model="passwordConfirmation"
              type="password"
              label="Confirmer mon mot de passe"
              :rules="passwordRules,samePasswordRules"
              @keyup.enter="submit"
            ></v-text-field>

            <v-btn
              color="secondary"
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
import { mapState } from 'vuex'

export default {
  name: 'TheMeAccount',

  data () {
    return {
      snackbar: false,
      snackbarText: '',
      snackbarState: 'error',
      isValid: false,
      passwordRules: [
        value => value.length >= 3 || 'Min 3 caractères.',
        value => value.length < 25 || 'Max 25 caractères.',
        value => !!value || 'Obligatoire.'
      ],
      samePasswordRules: value => value === this.password || 'Le mot de passe doit correspondre.',
      differentPasswordRules: value => value !== this.currentPassword || 'Veuillez renseigner un nouveau mot de passe différent de l\'ancien',
      currentPassword: '',
      password: '',
      passwordConfirmation: ''
    }
  },

  computed: mapState(['user']),

  methods: {
    async submit () {
      if (!this.$refs.user.validate()) return
      try {
        this.user.currentPassword = this.currentPassword
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
          case 403:
            this.snackbarText = 'Mot de passe incorect'
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
