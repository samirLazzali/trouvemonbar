<template>
  <div>
    <div>
      Vous avez cherché:
      <v-chip
        v-for="keyword in keywords"
        :key="keyword"
      >
        {{ keyword }}
      </v-chip>
    </div>

    <v-container fluid grid-list-xl>
      <v-layout row wrap>
        <bar
          v-for="{ id, name, address } in bars"
          :key="id"
          :id="id"
          :name="name"
          :address="address"
        ></bar>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Bar from '@/components/Bar'

export default {
  name: 'TheSearch',

  components: {
    Bar
  },

  computed: {
    keywords () {
      return this.$store.state.keywords
    },
    bars () {
      return this.$store.state.bars
    }
  }
}
</script>
