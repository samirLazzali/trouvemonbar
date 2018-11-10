<template>
  <v-card class="pa-3 ml-2 mr-2 mt-3">
    <v-layout align-center justify-space-between fill-height>
      <v-avatar
      class="ml-3"
        slot="activator"
        size="42px"
      >
        <img class="mt-4" :src="avatar" alt="Avatar">
        <span class="pl-2 grey--text" > {{ comment.pseudo }}</span>
      </v-avatar>
      <span>{{ comment.datecom }} </span>
    </v-layout>
    <p class="ml-5" v-html="comment.content"></p>
    <template v-if="this.$store.getters.isAuthenticated">
      <v-layout justify-end>
        <v-icon  >clear</v-icon><v-icon >create</v-icon>
      </v-layout>
    </template>
  </v-card>
</template>

<script>
export default {

  props: {
    comment: Object
  },

  computed: {
    avatar: function () {
      console.log(this.comment)
      return 'https://api.adorable.io/avatars/48/' + this.comment.iduser.toString().toLowerCase().trim().replace(/[\s\W-]+/g, '-') + '@adorable.io.png'
    }
  }

}
</script>
