<template>
  <div>
    <search-bar
      :keywords="keywords"
      v-model="selectedKeywords"
      @search="search"
    ></search-bar>

    <v-container fluid grid-list-xl>
      <v-progress-linear
        v-if="loading"
        color="success"
        height="4"
        indeterminate
      ></v-progress-linear>

      <v-alert
        :value="alert"
        type="info"
      >
        Désolé, mais votre recherche n'a rien donné.
        Essayez avec d'autres mots clés !
      </v-alert>

      <v-layout row wrap>
        <bar
          v-for="{ id, name, address, keywords } in bars"
          :key="id"
          v-bind:id="id"
          :name="name"
          :address="address"
          :keywords="keywords"
        ></bar>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Bar from '@/components/Bar'
import SearchBar from '@/components/SearchBar'

export default {
  name: 'TheSearch',

  components: {
    Bar,
    SearchBar
  },

  props: {
    query: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      keywords: [],
      selectedKeywords: [],
      bars: [],
      loading: true,
      alert: false
    }
  },

  created () {
    this.$api.getKeywords()
      .then(keywords => (this.keywords = keywords))
      .catch(this.$log.error)
  },

  watch: {
    query: {
      immediate: true,
      handler () {
        this.$log.debug(this.query)

        this.selectedKeywords = this.query.q.split(',')
        this.loading = true

        this.$api.getBars(this.query)
          .then(bars => {
            this.bars = bars
            this.alert = false
          })
          .catch(err => {
            this.$log.error(err)

            if (err.response.status === 404) this.alert = true
          })
          .finally(() => (this.loading = false))
      }
    }
  },

  methods: {
    search () {
      if (this.selectedKeywords.join(',') === this.query.q) return
      if (this.selectedKeywords.length === 0) return

      this.bars = []
      this.loading = true
      this.$router.push(`/search?q=${this.selectedKeywords.join(',')}`)
    }
  }
}
</script>
