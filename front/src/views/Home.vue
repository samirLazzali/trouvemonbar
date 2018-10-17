<template>
  <div>
    <the-user-page></the-user-page>
  </div>
</template>

<script>
// @ is an alias to /src
import TheUserPage from '@/components/TheUserPage.vue'

export default {
  name: 'home',

  components: {
    TheUserPage
  }
}
</script>
