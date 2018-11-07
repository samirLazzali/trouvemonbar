<template>
  <v-content>
    <v-card flat>
      <v-card-text>
        <v-container color="white">
          <v-card-text v-if="keywords">Vos mots clés actuels (Clicker pour supprimer) :</v-card-text>

          <v-chip
            id="keywordsList"
            v-for="keyword in userKeywords"
            :key="keyword.id"
            @click="deleteKeyword(keyword.id)"
            outline color="green"
          >
            {{ keyword.name | capitalize }}
          </v-chip>

          <v-card-title class="headline">Ajoutez des nouveaux mots clés que vous appréciez !</v-card-title>

          <v-autocomplete
            v-model="newKeywordsIds"
            :items="allKeywords"
            item-text="name"
            item-value="id"
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
  </v-content>
</template>

<script>
import Toaster from '@/toaster.js'
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
      newKeywordsIds: [],
      userKeywords: this.keywords
    }
  },

  computed: {
    allKeywords () {
      return this.$store.state.keywords
        .filter(k => !this.keywords.includes(k))
    }
  },

  methods: {
    async addKeyword () {
      if (this.newKeywordsIds.length > 0) {
        try {
          await this.$api.addKeywords(this.$store.state.user.id, this.newKeywordsIds)
          Toaster.$emit('success', 'Mots clés ajoutés avec succès.')
          this.userKeywords.push(
            ...this.allKeywords
              .filter(k => this.newKeywordsIds.includes(k.id)))
          this.userKeywords.sort((a, b) => a.name.localeCompare(b.name))
        } catch (err) {
          this.$log.error(err)
          switch (err.response.status) {
            case 400:
              Toaster.$emit('error', 'Paramètres invalides.')
              break
            case 418:
              Toaster.$emit('error', 'Mot clé déjà existant.')
              break
            case 500:
              Toaster.$emit('error', 'Erreur interne.')
              break
            default:
              Toaster.$emit('error', 'Une erreur s\'est produite')
              break
          }
          this.snackbar = true
        }
      }
    },
    async deleteKeyword (id) {
      if (typeof id !== 'undefined') {
        try {
          await this.$api.deleteKeyword(this.$store.state.user.id, id)
          Toaster.$emit('success', 'Mots clés supprimés avec succès.')
          this.userKeywords = this.userKeywords.filter(k => k.id !== id)
          this.userKeywords.sort((a, b) => a.name.localeCompare(b.name))
        } catch (err) {
          this.$log.error(err)
          switch (err.response.status) {
            case 400:
              Toaster.$emit('error', 'Paramètres invalides.')
              break
            case 418:
              Toaster.$emit('error', 'Mot clé déjà existant.')
              break
            case 500:
              Toaster.$emit('error', 'Erreur interne.')
              break
            default:
              Toaster.$emit('error', 'Une erreur s\'est produite')
              break
          }
          this.snackbar = true
        }
      }
    }
  }
}
</script>
