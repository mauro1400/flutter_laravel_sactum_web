<template>
    <div class="container-fluid">
        <!--Main Navigation-->
        <header>
            <Sidebar></Sidebar>
            <Nav></Nav>
        </header>
        <!--Main Navigation-->
        <!--Main layout-->
        <main style="padding-top: 70px;padding-left: 250px;">
            <router-link to="/listar-estudiantes" class="btn btn-primary"
                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                Volver atrás</router-link>

            <h2 class="mb-4">***Formulario de Estudiante***</h2>
            <!-- Alerta de Actualización -->
            <div v-if="showAlert" class="alert alert-info" role="alert">
                Registro insertado con éxito! Redirigiendo en {{ countDown }} segundos.
            </div>
            <form @submit.prevent="submitForm">
                <label for="p_nombres">Nombres</label>
                <input type="text" id="p_nombres" v-model="p_nombres">
                <label for="p_primer_apellido">Primer Apellido</label>
                <input type="text" id="p_primer_apellido" v-model="p_primer_apellido">
                <label for="p_segundo_apellido">Segundo Apellido</label>
                <input type="text" id="p_segundo_apellido" v-model="p_segundo_apellido">
                <label for="p_ci">CI</label>
                <input type="text" id="p_ci" v-model="p_ci">
                <label for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="p_fecha_nacimiento" v-model="p_fecha_nacimiento">
                <label for="p_genero">Género</label>
                <select id="p_genero" v-model="p_genero">
                    <option value="0">Femenino</option>
                    <option value="1">Masculino</option>
                </select>
                <label for="p_direccion">Dirección</label>
                <input type="text" id="p_direccion" v-model="p_direccion">
                <label for="p_celular">Celular</label>
                <input type="text" id="p_celular" v-model="p_celular">
                <label for="p_grado">Grado</label>
                <input type="text" id="p_grado" v-model="p_grado"> <button type="submit" class="btn btn-primary"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Enviar</button>
            </form>
        </main>
    </div>
</template>

<script>
import axios from 'axios';
import Sidebar from '../Sidebar.vue'; // Importando el componente Sidebar
import Nav from '../Nav.vue'
export default {
    components: {
        Sidebar,
        Nav, // Registrando el componente Sidebar
    },
    data() {
        return {
            p_nombres: '',
            p_primer_apellido: '',
            p_segundo_apellido: '',
            p_ci: '',
            p_fecha_nacimiento: '',
            p_genero: '',
            p_direccion: '',
            p_celular: '',
            p_grado: '',
            csrfToken: null,
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, // Agregando variable para mensaje de éxito
        };

    },
    mounted() {
        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (csrfTokenElement !== null) {
            this.csrfToken = csrfTokenElement.getAttribute('content');
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/insertar-persona-estudiante', {
                    p_nombres: this.p_nombres,
                    p_primer_apellido: this.p_primer_apellido,
                    p_segundo_apellido: this.p_segundo_apellido,
                    p_ci: this.p_ci,
                    p_fecha_nacimiento: this.p_fecha_nacimiento,
                    p_genero: this.p_genero,
                    p_direccion: this.p_direccion,
                    p_celular: this.p_celular,
                    p_grado: this.p_grado,
                }, {
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                this.showAlert = true; // muestra la alerta
                this.countDown = 2; // reinicia el contador
                setInterval(() => {
                    if (this.countDown > 0) {
                        this.countDown--; // decrementa el contador
                    } else {
                        this.$router.push('/listar-estudiantes');
                        location.reload()
                    }
                }, 1000);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>