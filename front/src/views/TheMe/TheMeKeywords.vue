<template>
  <div>
    <v-card flat>
      <v-card-text>
        <v-card-text>
          <h4>Vos mots clés actuels :</h4>

          <v-chip
            id="keywordsList"
            v-for="(keyword, i) in user.keywords"
            :key="i"
            @input="deleteKeywordsOfUser(keyword.id)"
            outline
            color="primary"
            close
          >
            {{ keyword.name | capitalize }}
          </v-chip>

          <v-card-title class="headline">
            Ajoutez des nouveaux mots clés que vous appréciez !
          </v-card-title>

          <v-autocomplete
            v-model="newKeywordsIds"
            :items="allowedUserKeywords"
            item-text="name"
            item-value="id"
            label="Mots clés"
            multiple
          ></v-autocomplete>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="secondary"
            :loading="loading"
            @click="addKeyword"
          >
            Ajoutez
          </v-btn>
        </v-card-actions>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
  name: 'TheMeKeywords',

  filters: {
    capitalize (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  },

  data () {
    return {
      newKeywordsIds: [],
      loading: false
    }
  },

  computed: {
    ...mapState(['user']),
    ...mapGetters(['allowedUserKeywords'])
  },

  methods: {
    ...mapActions([
      'addKeywordsToUser',
      'deleteKeywordsOfUser'
    ]),

    async addKeyword () {
      try {
        this.loading = true
        await this.addKeywordsToUser(this.newKeywordsIds)
      } catch (err) {
        this.$log.error(err)
      } finally {
        this.loading = false
        this.newKeywordsIds = []
      }
    }
  }
}
</script>
