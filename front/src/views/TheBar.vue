<template>
  <div v-if="bar">
    <v-flex xs12>
      <v-parallax class="para" height="400" :src="require('@/assets/img/bg7.jpg')">
        <v-layout
          align-center
          column
          justify-center
        >
        <h1 class="display-3 font-weight-thin mb-5 pb-5">{{ bar.name }}</h1>
        </v-layout>
      </v-parallax>

      <v-card color="margin_test" class=" ml-5 mr-5 pt-5 mb-5 elevation-23" >
        <v-layout>
          <v-flex xs4>
            <v-img
              :src="`https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${bar.photoreference}&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo`"
              height="200px"
              contain
            ></v-img>
          </v-flex>

          <v-flex xs7>
            <v-card-title primary-title>
              <v-card-actions class="display-1">
                <v-spacer></v-spacer>
              </v-card-actions>

              <div class="headline">Mots clefs:</div>

              <div>
                <v-chip
                  v-for="keyword in bar.keywords"
                  :key="keyword"
                  outline color="green darken-1"
                >
                  {{ keyword }}
                </v-chip>
                <v-rating
                  v-model="bar.rating"
                  color="yellow darken-3"
                  background-color="grey darken-1"
                  empty-icon="$vuetify.icons.ratingFull"
                  half-increments
                  hover
                  readonly
                ></v-rating>
              </div>
            </v-card-title>
          </v-flex>
        </v-layout>

        <v-divider class="mt-5 elevation-2 " light ></v-divider>

        <v-card color="" class=" pb-5">
          <v-card-title primary-title>
            <div class="display-1">Description</div>
          </v-card-title>

          <v-card-text>
            <div class="subheading">
              Nom : {{ bar.name }}
              <br>
              Addresse : {{ bar.address }}
            </div>
          </v-card-text>

          <v-container>

            <GmapMap
              :center="center"
              :zoom="15"
              map-type-id="terrain"
              style="width: 700px; height: 400px"
            >
              <GmapMarker
                :position="marker.position"
                clickable
                draggable
                @click="center = marker.position"
              />
            </GmapMap>
          </v-container>
        </v-card>
      </v-card>
    </v-flex>
  </div>
</template>

<script>
import Bar from '@/components/Bar'
import SearchBar from '@/components/SearchBar'

export default {
  name: 'TheBar',

  components: {
    Bar,
    SearchBar
  },

  data () {
    return {
      keywords: [],
      bar: null,
      loading: true,
      lorem: `lorem`,
      center: {
        lat: 10,
        lng: 10
      },
      marker: {
        position: {
          lat: 10,
          lng: 10
        }
      }
    }
  },

  created () {
    this.$api.getBar(this.$route.params.id)
      .then(bar => {
        this.$log.debug(bar)

        this.bar = bar
        this.bar.rating = Number.parseFloat(bar.rating)
        const position = {
          lat: Number.parseFloat(bar.lat),
          lng: Number.parseFloat(bar.lng)
        }
        this.marker.position = position
        this.center = position
      })
      .catch(this.$log.error)
  }
}
</script>

<style>
.titled {
  margin-top: -100px;
}
.margin_test {
  margin-top: -48px;
}
.para {
  margin-top: -30px;
}
</style>
