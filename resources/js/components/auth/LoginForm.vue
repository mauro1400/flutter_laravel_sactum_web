<template>
  <main class="form-signin w-100 m-auto">
    <form class="p-4 bg-light" @submit.prevent="login">
      <h1 class="h3 mb-3 fw-normal">Iniciar Secion</h1>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" class="form-control" v-model="form.email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" class="form-control" v-model="form.password">
      </div>
      <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
    </form>
  </main>
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
        location.reload()
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
  