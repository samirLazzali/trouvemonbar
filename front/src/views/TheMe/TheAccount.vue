<template>
  <v-card flat>
    <v-card-text>
      <v-container>
        <v-text-field
          label="Email"
          :value="email"
          disabled
        ></v-text-field>

        <v-text-field
          label="Pseudo"
          :value="pseudo"
          disabled
        ></v-text-field>

        <v-text-field
          v-model="password"
          type="password"
          label="Modifier mon mot de passe"
          disabled
        ></v-text-field>

        <v-text-field
          v-model="confirmPassword"
          type="password"
          label="Confirmer mon mot de passe"
          disabled
        ></v-text-field>

        <v-btn color="success" disabled>Modifier</v-btn>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'TheAccount',

  props: {
    email: {
      type: String,
      required: true
    },
    pseudo: {
      type: String,
      required: true
    }
  },

  data () {
    return {
      password: null,
      confirmPassword: null
    }
  }
}
</script>
