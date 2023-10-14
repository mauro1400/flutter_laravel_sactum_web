<template>
  <div style="height: 100%;">
    <a href="/">
      <span>Sidebar</span>
    </a>
    <hr>
    <ul>
      <li>
        <router-link :to="{ name: 'admin' }">
          Panel de Control del Administrador
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'index' }">
          Gestión de Usuarios
        </router-link>
      </li>
      <!-- Add similar code for other navigation links -->
    </ul>
    <hr>
    <div class="container text-center d-flex align-items-center justify-content-center">
      <div class=" dropdown">
        <a type="button" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
          &nbsp;<span>Usuario</span></a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li v-if="isLoggedIn">
            <router-link :to="{ name: 'user' }" class="dropdown-item">Perfil de Usuario</router-link>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" @click="logout">Cerrar Sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</template> 
<script>
export default {
  data() {
    return {};
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
  },
  created() { },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token')
    }
  },
};
</script>
