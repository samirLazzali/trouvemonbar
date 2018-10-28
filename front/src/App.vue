<template>
  <v-app id="app">
    <v-toolbar app>
      <v-btn to="/" fab flat color="transparent">
        <img src="./assets/logo.png" alt="logo">
      </v-btn>
      <v-toolbar-title>Trouvemonbar.com</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-toolbar-items>
        <template v-if="$store.getters.isAuthenticated">
          <v-btn color="success" flat>Bonjour {{ user.pseudo }}</v-btn>
          <v-btn color="success" flat @click="logout">Déconnexion</v-btn>
        </template>
        <template v-else>
          <v-btn color="success" flat to="/signup">S'inscrire</v-btn>
          <v-btn color="success" flat to="/signin">Connexion</v-btn>
          </template>
      </v-toolbar-items>
    </v-toolbar>

    <v-content>
      <v-container>
        <v-fade-transition mode="out-in">
          <router-view/>
        </v-fade-transition>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'App',

  computed: {
    user () {
      return this.$store.state.user
    }
  },

  methods: {
    logout () {
      this.$log.debug('logout', this.user)
      this.$store.dispatch('logout')
    }
  }
}
</script>
