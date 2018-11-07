<template>
  <v-flex xs12 sm6 md4 xl3 @click="$emit('clicked', id)">
    <v-hover>
      <v-card
        slot-scope="{ hover }"
        :class="`elevation-${hover ? 12 : 2}`"
        class="mx-auto"
      >
        <v-img
          :aspect-ratio="16/9"
          :src="`https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${photoReference}&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo`"
        ></v-img>

        <v-card-title>
          <div>
            <span class="headline">{{ name }}</span>

            <div>
              <v-chip
                v-for="(keyword, i) in keywords"
                :key="i"
              >{{ keyword }}</v-chip>
            </div>

            <div class="d-flex">
              <v-rating
                :value="Number.parseFloat(rating)"
                color="amber"
                dense
                half-increments
                readonly
                size="14"
              ></v-rating>

              <div class="ml-2 grey--text text--darken-2">
                <span>{{ rating }}</span>
                <span>(0)</span>
              </div>
            </div>
          </div>
        </v-card-title>
      </v-card>
    </v-hover>
  </v-flex>
</template>

<script>
export default {
  name: 'Bar',

  props: {
    id: {
      type: Number,
      required: true
    },

    name: {
      type: String,
      required: true
    },

    address: {
      type: String,
      required: true
    },

    keywords: {
      type: Array
    },

    photoReference: {
      type: String,
      required: true
    },

    rating: {
      type: String,
      required: true
    }
  }
}
</script>
