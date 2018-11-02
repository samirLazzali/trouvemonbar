<template>
  <v-flex  xs12 lg8 xl6 @click="$emit('clicked', id)">
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

            <div class="d-flex">
              <v-rating
                :value="name.length % 5"
                color="amber"
                dense
                half-increments
                readonly
                size="14"
              ></v-rating>

              <div class="ml-2 grey--text text--darken-2">
                <span>1</span>
                <span>({{ name.length }})</span>
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

    photoReference: {
      type: String,
      required: true
    },
    rating: {
      type: Number,
      required: true
    }
  }
}
</script>
