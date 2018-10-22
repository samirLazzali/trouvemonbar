<template>
  <div>
    <search-bar
      :keywords="keywords"
    ></search-bar>

    <v-container fluid grid-list-xl>
      <v-layout row wrap>
        <bar
          v-for="{ id, name, address } in bars"
          :key="id"
          v-bind:id="id"
          :name="name"
          :address="address"
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
      bars: []
    }
  },

  computed: {
    keywords () {
      return []
    }
  },

  created () {
    this.$log.debug(this.query)

    this.$api.searchRequest(this.query)
      .then(bars => (this.bars = bars))
      .catch(this.$log.error)
  }
}
</script>
