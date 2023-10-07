<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Estudiantes 2</h2>
                                    <hr>
                                    <div class="container">
                                        <router-link :to="{ name: 'ingresarEstudiante' }" class="btn btn-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Crear Registro
                                        </router-link>
                                    </div>
                                    <hr>
                                    <table class="table table-bordered border-primary">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Acciones</th>
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
                                            <tr v-for="estudiante in estudiantes" :key="estudiante.id_estudiante">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarEstudiante(estudiante.id_persona)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarEstudiante', params: { id_persona: estudiante.id_persona } }"
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ estudiante.nombres }}</td>
                                                <td>{{ estudiante.primer_apellido }} {{
                                                    estudiante.segundo_apellido }}</td>
                                                <td>{{ estudiante.ci }}</td>
                                                <td>{{ estudiante.fecha_nacimiento }}</td>
                                                <td>{{ estudiante.genero }}</td>
                                                <td>{{ estudiante.direccion }}</td>
                                                <td>{{ estudiante.celular }}</td>
                                                <td>{{ estudiante.grado }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
  
<script>
import axios from 'axios';
export default {
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
