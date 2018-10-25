<template>
  <div>
    <search-bar
      :keywords="keywords"
      v-model="selectedKeywords"
      @input.once="changed = true"
      @search="search"
    ></search-bar>

    <v-container fluid grid-list-xl>
      <v-progress-linear
        v-if="loading"
        color="success"
        height="4"
        indeterminate
      ></v-progress-linear>

      <v-layout row wrap>
        <bar
          v-for="{ id, name, address, keywords } in bars"
          :key="id"
          v-bind:id="id"
          :name="name"
          :address="address"
          :keywords="keywords.filter(k => selectedKeywords.includes(k))"
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
      loading: true
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

        this.$api.searchRequest(this.query)
          .then(bars => (this.bars = bars))
          .catch(this.$log.error)
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
