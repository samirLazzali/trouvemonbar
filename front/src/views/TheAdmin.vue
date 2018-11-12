<template>
  <div>
  <p class="display-2">
    Modération des avis
  </p>
  <v-data-table
    :headers="headers"
    :items="comments"
    class="elevation-1"
  >
    <template slot="items" slot-scope="props">
      <td class="text-xs" > {{ props.item.pseudo }}</td>
      <td class="text-xs-left">{{ props.item.nameBar }}</td>
      <td class="text-xs-left">{{ props.item.content }}</td>
      <td class="text-xs-center"><v-icon medium @click="deleteComment(props.item.id)" >delete</v-icon></td>
    </template>
  </v-data-table>
  </div>
</template>

<script>
import Toaster from '@/toaster.js'

export default {
  name: 'Admin',
  data () {
    return {
      comments: [],
      headers: [
        {
          text: 'Pseudo utlisateur',
          align: 'left',
          sortable: false,
          value: 'comments.pseudo'
        },
        { text: 'Nom du bar', value: 'comments.nameBar' },
        { text: 'Commentaire', value: 'comments.content' },
        { text: 'Supprimer', align: 'comments.id' }
      ]
    }
  },

  computed: {
    user () {
      return this.$store.state.user
    },
    keywords () {
      return this.$store.state.keywords || []
    }
  },

  created () {
    this.$api.getComments()
      .then(comments => {
        this.$log.debug(comments)
        this.comments = comments
      })
  },

  methods: {
    async deleteComment (id) {
      if (id) {
        try {
          await this.$api.deleteCommentAdmin(id)
          this.comments.splice(this.comments.findIndex(comment => comment.iduser === this.$store.state.user.id), 1)
          Toaster.$emit('success', 'Avis supprimé avec succès.')
        } catch (err) {
          this.$log.error(err)
          this.checkError(err.response.status)
        }
      }
    }
  }
}
</script>
