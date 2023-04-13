<template>
  <form @submit.prevent="register">
    <div>
      <label for="name">Name:</label>
      <input type="text" id="name" v-model="form.name">
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="form.email">
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="form.password">
    </div>
    <div>
      <label for="password_confirmation">Confirm Password:</label>
      <input type="password" id="password_confirmation" v-model="form.password_confirmation">
    </div>
    <button type="submit">Register</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('/api/register', this.form)
        localStorage.setItem('token', response.data.access_token)
        this.$router.push('/')
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
