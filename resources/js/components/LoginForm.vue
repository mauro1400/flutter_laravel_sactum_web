<template>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="form.email">
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="form.password">
      </div>
      <button type="submit">Log in</button>
    </form>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('/api/login', this.form)
          localStorage.setItem('token', response.data.access_token)
          this.$router.push('/user')
        } catch (error) {
          console.error(error)
        }
      }
    }
  }
  </script>
  