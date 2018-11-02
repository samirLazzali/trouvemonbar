<template>
  <div>
    <v-flex>
      <add-search-bar
        v-model="selectedText"
        @search="search"
      ></add-search-bar>
    </v-flex>

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
          v-for="({ id, name, photoreference }, i) in bars"
          :key="i"
          v-bind:id="id"
          :name="name"
          :address="address"
          :photo-reference="photoreference"
          @clicked="barClicked"
        ></bar>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
  import Bar from '@/components/AddBar'
  import AddSearchBar from '@/components/AddSearchBar'

  export default {
    name: 'TheAddSearch',

    components: {
      Bar,
      AddSearchBar
    },

    props: {
      query: {
        type: Object,
        required: true
      }
    },

    data() {
      return {
        selectedText: "",
        bars: [],
        loading: true,
        alert: false
      }
    },


    watch: {
      query: {
        immediate: true,
        handler() {
          this.$log.debug(this.query)

          this.selectedText = this.query.q;
          this.loading = true

          this.$api.addBars(this.query)
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
      search() {
        if (this.selectedText === this.query.q) return
        if (this.selectedText.length === 0) return

        this.bars = []
        this.loading = true
        this.$router.push(`/addsearch?q=${this.selectedText}`)
      },

      barClicked(id) {
        this.$log.debug('clicked', id)

        this.$router.push(`/bars/${id}`)
      }
    }
  }
</script>
