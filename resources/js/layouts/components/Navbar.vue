<template>
        <!-- Contenedor principal -->
        <div class="container-fluid">
            <!-- Marca -->
                <img src="/assets/brand/transporte.png" alt="Descripción de la imagen" class="img-fluid"
                    style="border-radius: 1rem; width: 50px; height: 50px; object-fit: cover;">
            <!-- Enlaces a la derecha -->
            <ul>
                <li v-if="isLoggedIn">
                    <router-link :to="{ name: 'user' }">Información de Usuario </router-link>
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
