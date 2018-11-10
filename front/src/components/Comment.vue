<template>
<li transition="slide">
  <div class="profile"><img :src="avatar" alt=""></div>
  <div class="msg">
    <div class="msg-body">
      <p class="name">{{ comment.pseudo }} <span class="date">{{ comment.datecom }} </span></p>
      <p v-html="comment.content"></p><span>  </span>
      <template v-if="isAuthenticated">
        <v-layout justify-end>
          <v-icon  >clear</v-icon><v-icon >create</v-icon>
        </v-layout>
      </template>
    </div>
  </div>
</li>
</template>

<script>
export default {

  props: {
    comment: Object,
    isAuthenticated: null
  },

  computed: {
    avatar: function () {
      return 'https://api.adorable.io/avatars/48/' + this.comment.iduser.toString().toLowerCase().trim().replace(/[\s\W-]+/g, '-') + '@adorable.io.png'
    }
  }

}
</script>
