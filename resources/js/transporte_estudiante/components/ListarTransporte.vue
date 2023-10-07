<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Transporte Estudiantes</h2>
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
                                                    <router-link
                                                        to="" @click.native="verTransporteEstudiante(transporte.id_transporte)"                                                        
                                                        class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        Lista Estudiantes
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
            axios.get("/api/listar-transporte").then((response) => {
                this.transportes = response.data.transporte;
            }).catch(({ response }) => {     
                this.$swal.fire(response.message, "se redireccionará a Inicio!", "error");
                this.$router.replace({ name: "login" });        
            });
    },
    methods: {
        verTransporteEstudiante(id_transporte) {            
            this.$router.replace({ name: 'listarTransporteEstudiante', params: { id_transporte: id_transporte } });              
            /*    await axios.get(`/api/listar-transporte-estudiante/${id_transporte}`).then((response) => {     
            }).catch(({ response }) => {     
                this.$swal.fire(response.message, "se redireccionará a Inicio!", "error");
                this.$router.replace({ name: "home" });        
            });*/                
        }
    },
};
</script>