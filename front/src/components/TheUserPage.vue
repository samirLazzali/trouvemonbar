<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="users"
    >
      <template slot="items" slot-scope="{ item }">
        <td>{{ item.id }}</td>
        <td>{{ item.firstname }}</td>
        <td>{{ item.lastname }}</td>
        <td>{{ item.birthday.date }}</td>
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
        { text: 'Firstname', value: 'firstname' },
        { text: 'Lastname', value: 'lastname' },
        { text: 'Birthday', value: 'birthday' }
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
