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
              <span v-show="loading" class="spinner"></span>
                <ul>
                    <comment v-for="comment in bar.comments" :key="comment.id" :comment="comment"></comment>
                </ul>
            </div>
            <template v-if="isAuthenticated">
              <comment-form v-on:commented="updateComment"></comment-form>
            </template>
            <template v-else>
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
import CommentForm from '@/components/CommentForm.vue'

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
      keywords: [],
      comments: [],
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
      .catch(err => {
        this.$log.error(err)

        if (err.response.status === 404) this.$router.push('/')
      })
  }
}
</script>

<style>
body {

  }

  .brand h3{
    color: #47b784;
    font-size: 2em;
  }
  .brand h3 span {
    color: #36495d
  }

  .btn-primary:hover {
    background-color: #47b784
  }
  .comment-list {
    padding: 1em 0;
  }
  .comment-list ul{
    margin: 0;
    padding: 1em;
  }
  .comment-list li{
    list-style: none;
    text-align: left;
    overflow: hidden;
    margin-bottom: 2em;
    padding: .4em;
  }
  .comment-list .profile {
    width: 80px;
    float: left;
  }
  .comment-list .profile img {
    border-radius: 50%;
    border: 2px solid #FFF;
    width: 48px;
    height: 48px;
    background-color: #DDD;
    box-shadow: 0 0 5px #DDD;
  }
  .comment-list .msg {
    width: 86%;
    float: left;
    background-color: #FFF;
    border-radius: 0 5px 5px 5px;
    box-shadow: 0 4px 8px -2px rgba(0,0,0, 0.05);
    position: relative;
  }
  .comment-list .msg-body {
    padding: .8em;
    color: #666;
    line-height: 1.5
  }
  .comment-list .msg-body p:last-child {
    margin-bottom: 0;
  }
  .comment-list .msg-body:after {
    content: ' ';
    position: absolute;
    left: -13px;
    top: 0;
    border: 14px solid;
    border-color: #fff transparent transparent transparent;
  }
  .comment-list .name {
    margin: 0;
    color: #999;
    font-weight: bold;
    font-size: .8em;
  }
  .comment-list .date {
    float: right;
  }
  @media(max-width: 1200px){
      #app{
           width: 80%;
      }
      .comment-list .msg {
        width: 80%;
      }
  }
  @media(max-width: 600px){
      #app{
           width: 95%;
           margin: 2rem auto;
      }
      .brand img {
        width: 80px;
      }
      .brand h3 {
        font-size: 1.6em;
      }
      .comment-list .msg {
        width: 70%;
      }
  }
  .spinner {
    width: 20px;
    height: 20px;
    background-color: #47b784;
    display: inline-block;
    -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
    animation: sk-rotateplane 1.2s infinite ease-in-out;
  }
  @-webkit-keyframes sk-rotateplane {
    0% { -webkit-transform: perspective(120px) }
    50% { -webkit-transform: perspective(120px) rotateY(180deg) }
    100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
  }
  @keyframes sk-rotateplane {
    0% {
      transform: perspective(120px) rotateX(0deg) rotateY(0deg);
      -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
      background-color: #47b784;
    } 50% {
      transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
      -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
      background-color: #36495d;
    } 100% {
      transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
      -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
      background-color: #47b784;
    }
  }
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
