<template>
  <v-card flat>
    <v-card-text>
      <v-container color="white">
        <v-card-title class="headline">Ajouter des nouveaux mots clés que vous appréssiez !</v-card-title>

        <v-autocomplete
          v-model="newKeywords"
          :items="allKeywords"
          item-text="name"
          item-value="id"
          label="Mots clés"
          multiple
        ></v-autocomplete>

        <v-chip
          v-for="(keyword, i) in keywords"
          :key="i"
          color="green"
          text-color="white"
        >
          {{ keyword }}
        </v-chip>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'TheKeywords',

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
      return this.$store.state.keywords || []
        .filter(k => !this.keywords.includes(k.name))
    }
  }
}
</script>
