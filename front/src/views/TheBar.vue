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
                  :key="keyword.id"
                  outline color="green darken-1"
                >
                  {{ keyword.name }}
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

          <v-container class="mapContainer">
            <v-card color="green lighten-5" class="pa-4 hidden-sm-and-down">
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
            </v-card>
            <div class="comment-list">
              <comment v-for="comment in bar.comments" :key="comment.idUser" :comment="comment" @deleteComment="deleteComment"></comment>
            </div>
            <template v-if="isAuthenticated">
              <comment-form :comment="comment" @submit="submit" v-model="submitted"></comment-form>
            </template>
          </v-container>
        </v-card>
      </v-card>
    </v-flex>
  </div>
</template>

<script>
import Bar from '@/components/Bar'
import SearchBar from '@/components/SearchBar'
import Comment from '@/components/Comment'
import CommentForm from '@/components/CommentForm'
import Toaster from '@/toaster.js'

export default {
  name: 'TheBar',

  components: {
    Comment,
    CommentForm,
    Bar,
    SearchBar
  },

  computed: {
    isAuthenticated () {
      return this.$store.getters.isAuthenticated
    }
  },

  data () {
    return {
      options: { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric' },
      today: new Date(),
      submitted: null,
      arrayComm: [],
      comment: Comment,
      tmpCom: Object,
      keywords: [],
      bar: null,
      loading: true,
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
        if (this.bar.comments === undefined) {
          this.bar.comments = []
        }
      })
      .catch(err => {
        this.$log.error(err)

        if (err.response.status === 404) this.$router.push('/')
      })
  },
  methods: {
    async submit (submitted) {
      if (submitted.content !== undefined) {
        try {
          await this.$api.addComment(this.idBar, {
            content: submitted.content,
            idUser: this.$store.state.user.id,
            idBar: this.bar.id,
            dateCom: this.today.toLocaleDateString('fr-FR', this.options)
          })
          Toaster.$emit('success', 'Avis ajouté avec succès.')
          this.tmpCom = {
            content: submitted.content,
            datecom: this.today.toLocaleDateString('fr-FR', this.options),
            idbar: this.bar.id,
            iduser: this.$store.state.user.id,
            pseudo: this.$store.state.user.pseudo
          }
          this.bar.comments.push(this.tmpCom)
        } catch (err) {
          this.$log.error(err)
          switch (err.response.status) {
            case 400:
              Toaster.$emit('error', 'Paramètres invalides.')
              break
            case 418:
              Toaster.$emit('error', 'Vous ne pouvez poster qu\'un seul avis sur ce bar')
              break
            case 500:
              Toaster.$emit('error', 'Erreur interne.')
              break
            default:
              Toaster.$emit('error', 'Une erreur s\'est produite')
              break
          }
          this.snackbar = true
        }
      } else {
        Toaster.$emit('error', 'Votre commentaire ne peut être vide')
      }
    },
    async deleteComment (comment) {
      if (typeof comment !== 'undefined') {
        try {
          await this.$api.deleteComment(this.$store.state.user.id, comment.idbar)
          this.bar.comments.splice(this.bar.comments.findIndex(comment => comment.iduser === this.$store.state.user.id), 1)
          Toaster.$emit('success', 'Avis supprimé avec succès.')
        } catch (err) {
          this.$log.error(err)
          switch (err.response.status) {
            case 400:
              Toaster.$emit('error', 'Paramètres invalides.')
              break
            case 500:
              Toaster.$emit('error', 'Erreur interne.')
              break
            default:
              Toaster.$emit('error', 'Une erreur s\'est produite')
              break
          }
          this.snackbar = true
        }
      }
    }
  }
}
</script>

<style>
.mapContainer {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 805px;
}
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
