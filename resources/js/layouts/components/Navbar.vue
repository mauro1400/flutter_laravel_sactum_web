<template>
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand">
                <img src="https://lasallelpt.edu.bo/images/logocolegio.jpg" alt="Descripción de la imagen" class="img-fluid"
        style="border-radius: 1rem; width: 50px; height: 50px; object-fit: cover;">
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <li v-if="isLoggedIn" class="nav-item">
                    <router-link class="nav-link me-3 me-lg-0" :to="{ name: 'user' }">Información de Usuario</router-link>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
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
  