<template>
  <v-app id="app">
    <v-toolbar app>
      <v-btn to="/" fab flat color="transparent" icon>
        <img src="./assets/logo.png" alt="logo" height="45" width="45">
      </v-btn>

      <v-toolbar-title>Trouvemonbar.com</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-toolbar-items>
        <template v-if="isAuthenticated">
          <v-menu bottom left offset-y>
            <v-btn icon large slot="activator" color="success">
              <v-icon>account_circle</v-icon>
            </v-btn>
            <v-list>
              <v-list-tile @click="$router.push('/me')">
                <v-list-tile-title>Mon compte</v-list-tile-title>
              </v-list-tile>
              <v-list-tile @click="logout">
                <v-list-tile-title>Déconnexion</v-list-tile-title>
              </v-list-tile>
            </v-list>
          </v-menu>
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
    isAuthenticated () { return this.$store.getters.isAuthenticated },
    user () { return this.$store.state.user }
  },

  methods: {
    logout () {
      this.$log.debug('logout', this.user)
      this.$store.dispatch('logout')
    }
  }
}
</script>
