<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="users"
      hide-actions
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
  name: 'TheUserPage',

  data () {
    return {
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Email', value: 'email' },
        { text: 'Hash', value: 'hash' },
        { text: 'Pseudo', value: 'pseudo' },
        { text: 'Role', value: 'role' }
      ],
      users: []
    }
  },

  created () {
    this.$api.getUsers()
      .then(users => (this.users = users))
  }
}
</script>
