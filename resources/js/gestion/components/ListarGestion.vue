<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Gestiones</h2>
                                    <hr>
                                    <div class="container">
                                        <router-link :to="{ name: 'ingresarGestion' }" class="btn btn-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Crear Gestion
                                        </router-link>
                                    </div>
                                    <hr>
                                    <table class="table table-bordered border-primary">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Gestion</th>
                                                <th>Periodo</th>
                                                <th>Descripcion</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="gestion in gestions" :key="gestions.id_gestion">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarGestion(gestion.id_gestion)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarGestion', params: { id_gestion: gestion.id_gestion } }"
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ gestion.gestion }}</td>
                                                <td>{{ gestion.periodo }}</td>
                                                <td>{{ gestion.descripcion_gestion }}</td>
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
            gestions: [],
            processing: false,
            errors: {},
            id_gestion:null         
        };
    },
    async created() {
        axios.get("/api/listar-gestion").then((response) => {
                this.gestions = response.data.listarGestion;                
            }).catch(({ response }) => {     
                this.$swal.fire(response.message, "se redireccionará a Inicio!", "error");
                this.$router.replace({ name: "login" });        
            }).finally(() => {
                this.processing = false;
            });        
    },
    methods: {
        async eliminarGestion(id_gestion) {
            this.processing = true;
            await axios.get('/api/eliminar-gestion/'+id_gestion).then((response) => {                
                this.$swal.fire('Eliminar Gestion!', '', 'success')
                this.gestions = this.gestions.filter(ges => ges.id_gestion !== id_gestion);                
            }).catch(({ response }) => {
                if (response.status === 422) {
                    this.errors = response.data.errors;
                } else if (response.status === 466) {
                    this.errors = response.data.errors;
                }
            }).finally(() => {
                this.processing = false;
            });            
        }
    },
};
</script>
