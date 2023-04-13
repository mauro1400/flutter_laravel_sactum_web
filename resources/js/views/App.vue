<template>
  <div>
    <nav>
      <router-link to="/login">Iniciar Sesion</router-link>
      <router-link to="/register">registrarse</router-link>
      <router-link v-if="isLoggedIn" to="/user">Informacion de Usuario</router-link>
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
