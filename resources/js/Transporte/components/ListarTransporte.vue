<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Transporte</h2>
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
                                                <th>Id_transporte</th>
                                                <th>Id_chofer</th>
                                                <th>Modelo</th>
                                                <th>Placa</th>
                                                <th>Nro De personas</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="transporte in transportes" :key="transporte.placa">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarApoderado(transporte.id_transporte)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarTransporte', params: { id_transporte: transporte.id_transporte } }"
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ transporte.id_transporte }}</td>
                                                <td>{{ transporte.id_chofer }}</td>
                                                <td>{{ transporte.modelo }}</td>
                                                <td>{{ transporte.placa }}</td>
                                                <td>{{ transporte.cant_persona }}</td>
                                                <td>{{ transporte.estado }}</td>
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
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            axios.get("/api/listar-transporte", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then((response) => {
                this.transportes = response.data.transporte;
            });

        } catch (error) {
            this.error = error.message;
        } finally {
            this.loading = false;
        }
    },
    methods: {
        async eliminarApoderado(id_transporte) {
            try {
                const token = localStorage.getItem('token');
                await axios.delete(`/api/eliminar-transporte/${id_transporte}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.transportes = this.transportes.filter(tran => tran.id_transporte !== id_transporte);
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
