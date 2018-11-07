<template>
  <v-container fluid grid-list-xl>
    <v-layout row wrap>
      <bar
        v-for="(bar, i) in bars"
        :key="i"
        :id="bar.id"
        :name="bar.name"
        :address="bar.address"
        :keywords="bar.keywords.filter(k => user.keywords.includes(k))"
        :photoReference="bar.photoreference"
        :rating="bar.rating"
        @clicked="$router.push(`/bars/${$event}`)"
      ></bar>
    </v-layout>
  </v-container>
</template>

<script>
import Toaster from '@/toaster.js'
import Bar from '@/components/Bar'

export default {
  name: 'TheFeed',

  components: {
    Bar
  },

  data () {
    return {
      bars: [],
      user: null
    }
  },

  async created () {
    try {
      this.user = await this.$api.getUserInfo(this.$store.state.user.id)
      this.bars = await this.$api.getBars({ q: this.user.keywords.join(',') })
    } catch (err) {
      this.$log.error(err)
      if (err.response.status === 401) {
        Toaster.$emit('info', 'Votre session a expiré')
        this.$store.dispatch('logout')
        this.$router.push('/signin')
      }
    }
  }
}
</script>
