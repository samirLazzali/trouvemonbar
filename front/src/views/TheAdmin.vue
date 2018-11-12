<template>
 <v-data-table
    :headers="headers"
    :items="desserts"
    class="elevation-1"
  >
    <template slot="items" slot-scope="props">
      <td>bla</td>
      <td class="text-xs-right"> test </td>
      <td class="text-xs-right"> test2 </td>
      <td class="text-xs-right"> test3 </td>
      <td class="text-xs-right"> test4 </td>
      <td class="text-xs-right"> test5 </td>
    </template>
  </v-data-table>
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
      selectedKeywords: []
    }
  },

  computed: {
    user () {
      return this.$store.state.user
    },
    keywords () {
      return this.$store.state.keywords || []
    }
  },

  created () {
    this.$store.dispatch('keywords')
  },

  methods: {
    search () {
      if (this.selectedKeywords.length === 0) return

      this.$router.push(`/search?q=${this.selectedKeywords.join(',')}`)
    }
  }
}
</script>
