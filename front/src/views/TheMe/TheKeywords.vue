<template>
  <v-content>
    <v-card flat>
      <v-card-text>
        <v-container color="white">
          <v-card-text v-if="keywords">Vos mots clés actuels :</v-card-text>

          <v-chip
            v-for="(keyword, i) in keywords"
            :key="i"
            outline color="green"
          >
            {{ keyword | capitalize }}
          </v-chip>

          <v-card-title class="headline">Ajoutez des nouveaux mots clés que vous appréciez !</v-card-title>

          <v-autocomplete
            v-model="newKeywords"
            :items="allKeywords"
            label="Mots clés"
            multiple
          ></v-autocomplete>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="success"
              @click="addKeyword"
            >
              Ajoutez
            </v-btn>
          </v-card-actions>

        </v-container>
      </v-card-text>
    </v-card>
    <v-snackbar
      v-model="snackbar"
      bottom
      left
      :color="snackbarState"
      :timeout="3000"
    >
      {{ snackbarText }}
    </v-snackbar>
  </v-content>
</template>

<script>
export default {
  name: 'TheKeywords',

  filters: {
    capitalize (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  },

  props: {
    keywords: {
      type: Array,
      required: true
    }
  },

  data () {
    return {
      newKeywords: [],
      snackbar: false,
      snackbarText: '',
      snackbarState: 'error'
    }
  },

  computed: {
    allKeywords () {
      return this.$store.state.keywords
    }
  },

  methods: {
    async addKeyword () {
      if (this.newKeywords.length > 0) {
        try {
          await this.$api.addKeywords(this.newKeywords)
          this.snackbarText = 'Mots clés ajoutés avec succès.'
          this.snackbarState = 'success'
          this.snackbar = true
        } catch (err) {
          this.$log.error(err)
          switch (err.response.status) {
            case 400:
              this.snackbarText = 'Paramètres invalides.'
              this.snackbarState = 'error'
              break
            case 418:
              this.snackbarText = 'Email ou login déjà utilisé.'
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
}
</script>
