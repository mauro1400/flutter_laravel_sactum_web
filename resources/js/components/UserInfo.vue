<template>
  <div>
    <h2>User Info</h2>
    <div v-if="user">
      <p>Nombre: {{ user.name }}</p>
      <p>Correo electrónico: {{ user.email }}</p>
      <button @click="logout">Cerrar sesión</button>
    </div>
    <div v-else-if="loading">
      Cargando datos de usuario...
    </div>
    <div v-else>
      Debe iniciar sesión para ver esta página.
    </div>
    <div v-if="error">{{ error }}</div>
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
        this.$router.push('/login')
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>

