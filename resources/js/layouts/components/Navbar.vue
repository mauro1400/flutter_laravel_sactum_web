<template>
    <!-- Contenedor principal -->
    <div>
        <!-- Marca -->
        <img src="/assets/brand/transporte.png" alt="Descripción de la imagen" class="img-fluid"
            style="border-radius: 1rem; width: 50px; height: 50px; object-fit: cover;">
        <!-- Enlaces a la derecha -->
        <ul>
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'user' }">Información de Usuario </router-link>
            </li>
        </ul>
         <!-- Enlaces a la derecha -->
        <ul>
            <li>
          <router-link :to="{ name: 'listarGrado' }">
            <span>Grados</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'listarGestion' }">
            <span>Gestiones</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'listarEstudiante' }">
            <span>Estudiantes</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'listarApoderado' }">
            <span>Apoderados</span>
          </router-link>
        </li>
        <li>
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
        </ul>
    </div>
    <!-- Barra de navegación -->
</template>

<script>
export default {
    computed: {
        isLoggedIn() {
            return !!localStorage.getItem('token')
        }
    },
}
</script>
