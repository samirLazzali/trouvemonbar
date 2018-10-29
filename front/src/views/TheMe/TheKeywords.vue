<template>
  <v-card flat>
    <v-card-text>
      <v-container color="white">
        <v-card-title class="headline">Ajouter des nouveaux mots clés que vous appréssiez !</v-card-title>

        <v-autocomplete
          v-model="newKeywords"
          :items="allKeywords"
          label="Mots clés"
          multiple
        ></v-autocomplete>

        <v-card-text>Vos mots clés actuels :</v-card-text>

        <v-chip
          v-for="(keyword, i) in keywords"
          :key="i"
          color="green"
          text-color="white"
        >
          {{ keyword | capitalize }}
        </v-chip>
      </v-container>
    </v-card-text>
  </v-card>
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
      newKeywords: []
    }
  },

  computed: {
    allKeywords () {
      return this.$store.state.keywords
    }
  }
}
</script>
