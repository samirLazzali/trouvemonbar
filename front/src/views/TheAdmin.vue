<template>
 <v-data-table
    :headers="headers"
    :items="desserts"
    class="elevation-1"
    :total-items="desserts.length"
  >
    <template slot="items" slot-scope="props">
      <td class="text-xs" > {{comments.pseudo }}</td>
      <td class="text-xs-right">{{ comments.idBar }}</td>
      <td class="text-xs-right">{{ props.item.fat }}</td>
      <td class="text-xs-center"><v-icon medium @click="" >delete</v-icon></td>
    </template>
  </v-data-table>
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
          value: 'comment.pseudo'
        },
        { text: 'Nom du bar', value: 'comment.nameBar' },
        { text: 'Commentaire', value: 'comment.content' },
        { text: 'Supprimer', align: 'comment.id' }
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
    async deleteComment (comment) {
      if (comment) {
        try {
          await this.$api.getComment(this.$store.state.user.id, this.bar.id)
            .then(commentId => {
              this.$log.debug(commentId)
              comment.id = commentId.data.id
            })
          await this.$api.deleteComment(comment.id, this.bar.id)
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
