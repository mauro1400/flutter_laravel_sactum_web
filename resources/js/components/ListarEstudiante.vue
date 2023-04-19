<template>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <Sidebar></Sidebar>
            <!-- Main Content -->
            <div class="col-md-10">

                <h1>Lista de Estudiantes</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>CI</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Celular</th>
                            <th>Grado</th>
                        </tr>
                    </thead>
                    <!-- Agregar botón "Eliminar" a la tabla -->
                    <tbody>
                        <tr v-for="estudiante in estudiantes" :key="estudiante.ci">
                            <td>{{ estudiante.nombres }}</td>
                            <td>{{ estudiante.primer_apellido }} {{ estudiante.segundo_apellido }}</td>
                            <td>{{ estudiante.ci }}</td>
                            <td>{{ estudiante.fecha_nacimiento }}</td>
                            <td>{{ estudiante.genero }}</td>
                            <td>{{ estudiante.direccion }}</td>
                            <td>{{ estudiante.celular }}</td>
                            <td>{{ estudiante.grado }}</td>
                            <td>
                                <button @click="eliminarEstudiante(estudiante.id_persona)">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
import Sidebar from '../components/Sidebar.vue';

export default {
    components: {
        Sidebar
    },
    data() {
        return {
            estudiantes: [],
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            axios.get("/api/listar-estudiantes", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then((response) => {
                this.estudiantes = response.data.estudiantes;
            });

        } catch (error) {
            this.error = error.message;
        } finally {
            this.loading = false;
        }
    },
    methods: {
        async eliminarEstudiante(id_persona) {
            try {
                const token = localStorage.getItem('token');
                await axios.delete(`/api/eliminar-estudiantes/${id_persona}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.estudiantes = this.estudiantes.filter(est => est.id_persona !== id_persona);
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
