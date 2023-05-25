<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Choferes</h2>
                                    <hr>
                                    <div class="container">
                                        <router-link :to="{ name: 'ingresarTransporte' }" class="btn btn-primary"
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
                                                <th>Transporte</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="chofer in choferes" :key="chofer.ci">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarChofer(chofer.id_persona)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarChofer', params: { id_persona: chofer.id_persona } }"
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ chofer.nombres }}</td>
                                                <td>{{ chofer.primer_apellido }} {{ chofer.segundo_apellido }}</td>
                                                <td>{{ chofer.ci }}</td>
                                                <td>{{ chofer.fecha_nacimiento }}</td>
                                                <td>{{ chofer.genero }}</td>
                                                <td>{{ chofer.direccion }}</td>
                                                <td>{{ chofer.cel }}</td>
                                                <td>{{ chofer.pin }}</td>
                                                <td v-if="transporte.id_chofer === chofer.id_chofer"
                                                    v-for="transporte in transportes" :key="transporte.id_transporte">
                                                    {{transporte.modelo }} <br>
                                                    {{transporte.placa }} <br>
                                                    {{transporte.descripcion }} <br> 
                                                </td>
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
            transportes: [],
            choferes: [],
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            axios.get("/api/listar-chofer", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then((response) => {
                this.choferes = response.data.listaChoferes;
            });
            axios.get("/api/listar-transporte", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then((response) => {
                this.transportes = response.data.transporte;
                console.log(response.data.transporte);
            });

        } catch (error) {
            this.error = error.message;
        } finally {
            this.loading = false;
        }
    },
    methods: {
        async eliminarChofer(id_persona) {
            try {
                const token = localStorage.getItem('token');
                await axios.delete(`/api/eliminar-chofer/${id_persona}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.choferes = this.choferes.filter(chof => chof.id_persona !== id_persona);
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
