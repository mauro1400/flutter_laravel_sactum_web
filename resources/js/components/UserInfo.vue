<template>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <Sidebar></Sidebar>
      <!-- Main Content -->
      <div class="col-md-10">
        <h2 class="mb-4">***Bienvenido***</h2>
        <div v-if="user" class="card mb-4">
          <div class="card-body">
            <p class="card-text">Nombre: {{ user.name }}</p>
            <p class="card-text">Correo electrónico: {{ user.email }}</p>
            <button @click="logout" class="btn btn-primary">Cerrar sesión</button>
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
    </div>
  </div>
</template>


<script>
import Sidebar from '../components/Sidebar.vue' // Importando el componente Sidebar

export default {
  components: {
    Sidebar // Registrando el componente Sidebar
  },
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

