<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Apoderados</h2>
                                    <hr>
                                    <div class="container">
                                        <router-link :to="{ name: 'ingresarApoderado' }" class="btn btn-primary"
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
                                                <th>Pin</th>
                                                <th>Estudiante</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="apoderado in apoderados" :key="apoderado.ci">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarApoderado(apoderado.id_persona)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarApoderado', params: { id_persona: apoderado.id_persona } }"
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ apoderado.nombres }}</td>
                                                <td>{{ apoderado.primer_apellido }} {{
                                                    apoderado.segundo_apellido }}</td>
                                                <td>{{ apoderado.ci }}</td>
                                                <td>{{ apoderado.fecha_nacimiento }}</td>
                                                <td>{{ apoderado.genero }}</td>
                                                <td>{{ apoderado.direccion }}</td>
                                                <td>{{ apoderado.celular }}</td>
                                                <td>{{ apoderado.pin}}</td>
                                                <td>{{ apoderado.id_estudiante}}</td>
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
            apoderados: [],
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            axios.get("/api/listar-apoderado", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then((response) => {
                this.apoderados = response.data.listaApoderados;
            });

        } catch (error) {
            this.error = error.message;
        } finally {
            this.loading = false;
        }
    },
    methods: {
        async eliminarApoderado(id_persona) {
            try {
                const token = localStorage.getItem('token');
                await axios.delete(`/api/eliminar-apoderado/${id_persona}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.apoderados = this.apoderados.filter(apo => apo.id_persona !== id_persona);
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
