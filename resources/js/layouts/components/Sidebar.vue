<template>
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link :to="{ name: 'listarGrado' }">
            <span>Grados</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'listarGestion' }">
            <span>Gestiones</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'listarEstudiante' }">
            <span>Estudiantes</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'listarApoderado' }">
            <span>Apoderados</span>
          </router-link>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#"
            class="nav-link"
            data-bs-toggle="dropdown"
            role="button"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <span>Transporte</span>
          </a>
          <div class="dropdown-menu">
            <router-link :to="{ name: 'listarChofer' }" class="dropdown-item">
              <span>Choferes</span>
            </router-link>
            <router-link :to="{ name: 'listarTransportes' }" class="dropdown-item">
              <span>Transportes Estudiante</span>
            </router-link>
          </div>
        </li>
        <!-- Agrega más elementos de la lista aquí si es necesario -->
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {};
    },
    methods: {},
    created() {},
    computed: {},
  };
  </script>
  