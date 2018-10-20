<template>
  <v-app id="app">
    <v-toolbar app>
      <v-btn to="/" fab flat color="transparent">
        <img src="./assets/logo.png" alt="logo">
      </v-btn>
      <v-toolbar-title>Awesome Website</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat to="/users">Users</v-btn>
        <v-btn flat>S'inscrire</v-btn>
        <v-btn flat>Connexion</v-btn>
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
  name: 'App'
}
</script>
