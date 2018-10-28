<template>
  <div v-if="user">
    <v-parallax
      src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
      height="200"
    >
      <v-layout column>
        <v-spacer></v-spacer>
        <v-avatar size="80">
          <img
            src="https://cdn.vuetifyjs.com/images/john.jpg"
            :alt="user.pseudo"
          >
        </v-avatar>
        <h1 class="display-2 font-weight-thin mb-3">{{ user.pseudo }}</h1>
      </v-layout>
    </v-parallax>

    <v-tabs
      slot="extension"
      v-model="tab"
      grow
    >
      <v-tab>Mots clés</v-tab>
      <v-tab>Mon compte</v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item>
        <the-keywords :keywords="user.keywords"></the-keywords>
      </v-tab-item>

      <v-tab-item>
        <the-account
          :email="user.email"
          :pseudo="user.pseudo"
        ></the-account>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import TheKeywords from './TheKeywords'
import TheAccount from './TheAccount'

export default {
  name: 'TheMe',

  components: {
    TheKeywords,
    TheAccount
  },

  data () {
    return {
      user: null,
      tab: 0,
      newKeywords: []
    }
  },

  computed: {
    isAuthenticad () {
      return this.$store.getters.isAuthenticad
    },

    keywords () {
      return this.$store.state.keywords
    }
  },

  watch: {
    isAuthenticad () {
      if (!this.isAuthenticad) this.$router.push('/')
    }
  },

  created () {
    this.$store.dispatch('keywords')

    this.$api.getUserInfo(this.$store.state.user.id)
      .then(user => {
        this.$log.debug(user)
        this.user = user
      })
      .catch(err => {
        this.$log.error(err)
      })
  }
}
</script>
