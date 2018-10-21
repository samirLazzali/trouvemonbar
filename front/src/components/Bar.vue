<template>
  <v-flex xs12 sm6 md4>
    <v-hover>
      <v-card
        slot-scope="{ hover }"
        :class="`elevation-${hover ? 12 : 2}`"
        class="mx-auto"
      >
        <v-img
          :aspect-ratio="16/9"
          src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
        ></v-img>

        <v-card-title>
          <div>
            <span class="headline">{{ name }}</span>
            <div class="d-flex">
              <v-rating
                :value="4"
                color="amber"
                dense
                half-increments
                readonly
                size="14"
              ></v-rating>
              <div class="ml-2 grey--text text--darken-2">
                <span>{{ 4 }}</span>
                <span>({{ 245 }})</span>
              </div>
            </div>
          </div>

          <v-spacer></v-spacer>

          <v-btn icon class="mr-0">
            <v-icon>arrow_right</v-icon>
          </v-btn>
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
    }
  }
}
</script>
