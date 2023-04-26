<template>
  <div class="container-fluid" style="padding-top: 21px;">
    <div v-if="user">
      <div class="card text-center">
        <div class="card-header">
          Usuario
        </div>
        <div class="card-body">
          <h5 class="card-title">Bienvenido</h5>
          <p class="card-text"><b>Nombre:</b> {{ user.name }}</p>
          <p class="card-text"><b>Correo electrónico:</b> {{ user.email }}</p>
          <button @click="logout" class="btn btn-primary">Cerrar sesión</button>
        </div>
        <div class="card-footer text-body-secondary">
          2023
        </div>
      </div>
    </div>
    <div v-else-if="loading" class="alert alert-info" role="alert">
      Cargando datos de usuario...
    </div>
    <div v-else class="alert alert-warning" role="alert">
      Debe iniciar sesión para ver esta página.
    </div>
    <div v-if="error" class="alert alert-danger" role="alert">{{ error }}</div>
  </div>
</template>


<script>

export default {
  data() {
    return {
      user: null,
      loading: true,
      error: null
    }
  },
  async created() {
    try {
      const token = localStorage.getItem('token')
      const response = await axios.get('/api/user', {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      this.user = response.data
    } catch (error) {
      console.error(error)
    }
  },
  methods: {
    async logout() {
      try {
        const token = localStorage.getItem('token')
        await axios.post('/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        localStorage.removeItem('token')
        this.$router.push('/')
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>

