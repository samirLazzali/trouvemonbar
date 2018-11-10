<template>
  <div class="comment-box" id="comment">
    <div class="loader" v-show="loading2" >
      <span class="spinner"></span>
    </div>
    <form action="" method="post" @submit.prevent="submit">
      <textarea v-model="comment.content" class="input-message" name="message" id="message" rows="3" placeholder="Donnez votre avis!" required></textarea>
      <v-layout justify-end>
        <v-btn
          :disabled="loading2"
          large
          color="secondary"
          @click="$emit('submit', comment)"
          v-text="'Comment'"
        ></v-btn>
      </v-layout>
    </form>
  </div>
</template>

<script>
export default {
  name: 'CommentForm',
  data () {
    return {
    }
  },
  props: {
    comment: {
      type: Object,
      required: true
    },
    loading2: Boolean
  }
}
</script>

<style>

  .comment-box {
    background-color: #FFF;
    width: 100%;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0,0,0, 0.1);
  }
  .comment-box form {
    padding: 1rem;
  }
   .comment-box input, .comment-box textarea {
    font-size: .8em;
    width: 97.3%;
    padding: .6em;
    border: 1px solid #EEE;
    background-color: #f7f7f7;
    display: block;
    margin-bottom: 1em;
    font-family: 'Raleway', sans-serif;
    transition: all ease 0.3s;
  }
  .comment-box input:focus, .comment-box textarea:focus {
    border-color: #fcac38;
    outline: none;
    box-shadow: inset 0 0 3px #DDD;
  }
  .comment-box input[type="submit"]:focus {
    background-color: #36495d;
  }
  .comment-box input[type="submit"] {
    margin-bottom: 0;
    width: 30%;
    background-color: #fcac38;
    color: #FFF;
    border-color: #fcac38;
    font-weight: bold;
    text-transform: uppercase;
  }
  .comment-box input[type="submit"]:disabled {
    opacity: 0.6
  }
  .test:disabled {
    opacity: 0.6
  }
  #comment {
    position: relative;
  }
  #comment .spinner {
    margin-top: 5em;
    z-index: 999;
  }
  #comment .loader {
    text-align:center;
    content: '';
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 2;
  }
</style>
