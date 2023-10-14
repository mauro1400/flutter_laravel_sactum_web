<template>
  <div>
    <div class="container text-center">
      <div class="row justify-content-between">
        <div class="col-4">
          <h4>Lista de Usuarios</h4>
        </div>
        <div class="col-4">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <table class="table table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Acciones</th>
          <th>Nombre de Usuario</th>
          <th>Email</th>
          <th>Estado de usuario</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(usuario, index)  in usuarios" :key="usuario.id">
          <td>{{ index + 1 }}</td>
          <td><button class="btn btn-danger"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" @click="">
              <i class="bi bi-trash"></i>
            </button>
            <router-link :to="{ name: '', params: {} }" class="btn btn-warning"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
              <i class="bi bi-pencil-square"></i>
            </router-link>
          </td>
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
  },
  methods: {

  },
};
</script>