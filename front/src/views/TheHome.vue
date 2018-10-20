<template>
  <div>
    <v-card color="transparent" flat>
        <v-card-text class="light-green--text">
          <h1 class="text-xs-center">La flemme de chercher un bar ?</h1>
          <h1 class="text-xs-center">On s'occupe de tout !</h1>
        </v-card-text>
    </v-card>

    <v-layout row wrap>
      <v-flex xs12 lg2 xl3></v-flex>
      <v-flex xs12 lg8 xl6>
        <v-toolbar color="transparent" flat>
          <v-autocomplete
            :items="keywords"
            label="Ce que j'aimerais"
            multiple
            hide-no-data
            hide-details
            solo
          ></v-autocomplete>

          <v-btn large color="success">J'ai soif !</v-btn>
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
      keywords: ['Bière', 'Danse', 'Détente', 'Vin', 'Shot']
    }
  }
}
</script>
