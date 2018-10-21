<template>
  <div>
    <v-card color="transparent" flat>
        <v-card-text class="light-green--text">
          <h1 class="text-xs-center">La flemme de chercher un bar ?</h1>
          <h1 class="text-xs-center">On s'occupe de tout !</h1>
        </v-card-text>
    </v-card>

    <v-layout row wrap>
      <v-flex xs12 lg8 xl6 offset-lg2 offset-xl3>
        <v-toolbar color="transparent" flat>
          <v-autocomplete
            v-model="selected"
            :items="keywords"
            label="Ce que j'aimerais"
            multiple
            hide-no-data
            hide-details
            solo
          ></v-autocomplete>

          <v-btn
            large
            color="success"
            @click="search"
            :loading="loading"
            :disabled="loading"
            v-text="'J\'ai soif !'"
          ></v-btn>
        </v-toolbar>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Home',

  data () {
    return {
      selected: [],
      keywords: ['Bière', 'Danse', 'Détente', 'Vin', 'Shot'],
      loading: false
    }
  },

  methods: {
    search () {
      this.loading = true

      this.$store.dispatch('SEARCH_REQUEST', this.selected)
        .then(() => {
          this.$router.push('/search')
          this.loading = false
        })
    }
  }
}
</script>
