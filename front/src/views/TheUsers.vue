<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="users"
      hide-actions
      :loading="loading"
    >
      <template slot="items" slot-scope="{ item }">
        <td>{{ item.id }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.hash }}</td>
        <td>{{ item.pseudo }}</td>
        <td>{{ item.role }}</td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  name: 'TheUser',

  data () {
    return {
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Email', value: 'email' },
        { text: 'Hash', value: 'hash' },
        { text: 'Pseudo', value: 'pseudo' },
        { text: 'Role', value: 'role' }
      ],
      users: [],
      loading: true
    }
  },

  created () {
    this.$api.getUsers()
      .then(users => (this.users = users))
      .catch(console.error)
      .finally(() => (this.loading = false))
  }
}
</script>
