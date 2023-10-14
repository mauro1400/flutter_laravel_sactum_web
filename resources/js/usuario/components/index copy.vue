<template>
  <div>
      <h1>Gestion de Usuarios</h1>
      <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
          <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-person-fill-add"
                                  style="font-size: 2rem;"></i>
                              <h6>Agregar Usuario</h6>
                          </button>
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-card-checklist"
                                  style="font-size: 2rem;"></i>
                              <h6>Listar Usuario</h6>
                          </button>
                      </li>
                  </ul>

              </div>
          </div>
      </nav>
      <hr>
      <h4>Lista de Usuarios</h4>
      <hr>
      <table class="table table-sm">

          <thead>
              <tr>
                  <th>Nombre de Usuario</th>
                  <th>Email</th>
                  <th>Estado de usuario</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="usuario in usuarios" :key="usuario.id">
                  <td>{{ usuario.name }}</td>
                  <td>{{ usuario.email }}</td>
                  <td>
                      {{ usuario.estado === 1 ? 'Desactivado' : 'Activo' }}
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
      return {
          usuarios: [], // Aquí debes cargar la lista de usuarios desde la API de Laravel
          searchQuery: '',
          processing: false,
          errors: {},
      };
  },
  async created() {
      axios.get("/api/listarUsuarios").then((response) => {
          this.usuarios = response.data.listaUsuarios;
          console.log(this.usuarios);
      });
  },
  computed: {
      filteredUsers() {
          // Aplicar filtro por búsqueda y rol
          let filtered = this.users;

          if (this.searchQuery) {
              filtered = filtered.filter(user =>
                  user.name.toLowerCase().includes(this.searchQuery.toLowerCase())
              );
          }
          return filtered;
      },
  },
  methods: {
      searchUsers() {
          // Realizar búsqueda en tiempo real aquí si es necesario
      },
  },
};
</script>