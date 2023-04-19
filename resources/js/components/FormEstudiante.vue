<template>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <Sidebar></Sidebar>
            <!-- Main Content -->
            <div class="col-md-10">
                <h2 class="mb-4">***Formulario de Estudiante***</h2>

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
                    <input type="text" id="p_grado" v-model="p_grado"> <button type="submit">Enviar</button>
                    <div v-if="errorMessage">{{ errorMessage }}</div>
                    <div v-if="successMessage">{{ successMessage }}</div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Sidebar from '../components/Sidebar.vue'; // Importando el componente Sidebar

export default {
    components: {
        Sidebar // Registrando el componente Sidebar
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
            errorMessage: null,
            successMessage: null, // Agregando variable para mensaje de éxito
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
                console.log(response.data);
                this.successMessage = 'Usuario insertado con éxito'; // Estableciendo mensaje de éxito
                setTimeout(() => {
                    this.successMessage = null; // Limpiando el mensaje de éxito después de 5 segundos
                }, 5000);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>