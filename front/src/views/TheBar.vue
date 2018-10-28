<template>
       <v-container fluid grid-list-sm>
      <v-layout row wrap color="brown">
        <v-flex d-flex xs12 order-xs5>
          <v-layout column>
            <v-flex d-flex>

              <v-card color="transparent" dark tile flat>
                 <v-chip color="green lighten-2" v-for="keyword in bar.keywords" :key="keyword" >{{keyword}}</v-chip>
              </v-card>
            </v-flex>
          </v-layout>

        </v-flex>


        <v-flex d-flex xs12 sm4>
            <v-img src="https://lh3.googleusercontent.com/p/AF1QipOQ3rYB5ZLuGaQZ7ic1nzcetIR24wF5diRTaaaJ=s1600-w400" aspect-ratio="1.7"></v-img>

        </v-flex>
        <v-flex d-flex xs12 sm4>
  <v-card
                  color="transparent"
                    tile
                    flat
                  >
                    <v-card-text><h1>{{ bar.name }}</h1></v-card-text>
                    <v-card-text><h3>{{ bar.address }}</h3></v-card-text>
                  </v-card>
        </v-flex>
      </v-layout>
    </v-container>
</template>

<script>
import Bar from '@/components/Bar';
import SearchBar from '@/components/SearchBar';

export default {
  name: 'TheBar',

  components: {
    Bar,
    SearchBar
  },

  props: {},

  data () {
    return {
      keywords: [],
      bar: [],
      loading: true,
      lorem: `lorem`
    }
  },

  created () {
    this.$api
      .getBar(this.$route.params.id)
      .then(bar => (this.bar = bar))
      .catch(this.$log.error)
  },

  watch: {}
}
</script>
