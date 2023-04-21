<template>
  <form class="p-3 bg-light" @submit.prevent="register">
    <div class="mb-3">
      <label for="name" class="form-label">Nombre:</label>
      <input type="text" id="name" v-model="form.name" class="form-control">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" id="email" v-model="form.email" class="form-control">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password" id="password" v-model="form.password" class="form-control">
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
      <input type="password" id="password_confirmation" v-model="form.password_confirmation" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
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
