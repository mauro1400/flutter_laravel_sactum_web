<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Mi Aplicación</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" to="/login">Iniciar Sesion</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/register">Registrarse</router-link>
            </li>
            <li v-if="isLoggedIn" class="nav-item">
              <router-link class="nav-link" to="/user">Información de Usuario</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
</template>


<script>
import LoginForm from '../components/LoginForm.vue'
import RegisterForm from '../components/RegisterForm.vue'
import UserInfo from '../components/UserInfo.vue'

export default {
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token')
    }
  },
  components: {
    LoginForm,
    RegisterForm,
    UserInfo
  }
}
</script>
