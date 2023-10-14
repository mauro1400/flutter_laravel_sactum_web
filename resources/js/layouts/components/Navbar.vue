<template>
    <!-- Contenedor principal -->
    <div>
        <!-- Marca -->
        <ul>
        <img src="/assets/brand/transporte.png" alt="Descripción de la imagen" class="img-fluid"
            style="border-radius: 1rem; width: 50px; height: 50px; object-fit: cover;">
        <!-- Enlaces a la derecha -->
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'user' }">Perfil de Usuario </router-link>
            </li>
        </ul>
      </div>
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
