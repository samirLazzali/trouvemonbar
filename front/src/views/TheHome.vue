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
        <search-bar
          :keywords="keywords"
          v-model="selectedKeywords"
          @search="search"
        ></search-bar>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import SearchBar from '@/components/SearchBar'

export default {
  name: 'Home',

  components: {
    SearchBar
  },

  data () {
    return {
      keywords: [],
      selectedKeywords: []
    }
  },

  created () {
    this.$api.getKeywords()
      .then(keywords => (this.keywords = keywords))
      .catch(this.$log.error)
  },

  methods: {
    search () {
      if (this.selectedKeywords.length === 0) return

      this.$router.push(`/search?q=${this.selectedKeywords.join(',')}`)
    }
  }
}
</script>
