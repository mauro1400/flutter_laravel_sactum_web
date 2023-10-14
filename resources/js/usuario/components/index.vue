<template>
  <div>
    <h1>Gestion de Usuarios</h1>
    <Navbar />
    <hr>
    <router-view />
  </div>
</template>

<script>
//import Navbar from './navbarUsuarios.vue';
//import UserTable from './ListaUsuarios.vue';
const Navbar = () => import(/* webpackChunkName: "Navbar" */ './navbarUsuarios.vue')

export default {
  components: {
    Navbar,
  },
};
</script>
