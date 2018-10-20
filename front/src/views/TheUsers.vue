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
        <td>{{ item.firstname }}</td>
        <td>{{ item.lastname }}</td>
        <td>{{ item.age }} years</td>
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
        { text: 'Firstname', value: 'firstname' },
        { text: 'Lastname', value: 'lastname' },
        { text: 'Age', value: 'age' }
      ],
      users: [],
      loading: true
    }
  },

  created () {
    this.$api.getUsers()
      .then(users => {
        this.users = users
        this.loading = false
      })
  }
}
</script>
